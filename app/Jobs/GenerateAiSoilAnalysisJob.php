<?php

namespace App\Jobs;

use App\Models\FarmerRequest;
use App\Models\SoilSampleResult;
use App\Services\GeminiAIService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class GenerateAiSoilAnalysisJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** Number of times the job may be attempted */
    public int $tries = 5;

    /** Timeout in seconds (15 minutes) */
    public int $timeout = 900;

    public function __construct(
        protected int $soilSampleResultId
    ) {}

    public function handle(): void
    {
        $result = SoilSampleResult::find($this->soilSampleResultId);
        if (!$result) {
            Log::error("GenerateAiSoilAnalysisJob: SoilSampleResult #{$this->soilSampleResultId} not found.");
            return;
        }

        // Mark as processing so the UI can show a spinner
        $result->update(['ai_analysis_status' => 'processing']);

        $farmerRequest = FarmerRequest::with([
            'farmer',
            'farm',
            'farmerRequestSamples',
            'soilSampleResult.soilSample',
        ])->find($result->request_id);

        if (!$farmerRequest) {
            Log::error("GenerateAiSoilAnalysisJob: FarmerRequest not found for result #{$this->soilSampleResultId}.");
            $result->update(['ai_analysis_status' => 'failed']);
            return;
        }

        $ai   = new GeminiAIService();
        $text = $ai->generateSoilAnalysis($farmerRequest);

        if ($text) {
            $result->update([
                'ai_analysis'        => $text,
                'ai_analysis_status' => 'pending',
            ]);
            Log::info("GenerateAiSoilAnalysisJob: Success for result #{$this->soilSampleResultId}. Length: " . strlen($text));
        } else {
            $result->update(['ai_analysis_status' => 'failed']);
            Log::error("GenerateAiSoilAnalysisJob: Failed for result #{$this->soilSampleResultId}.");
            throw new \RuntimeException('Gemini API returned no text. Will retry.');
        }
    }

    /** Seconds to wait before retrying */
    public function backoff(): array
    {
        return [15, 45, 90, 180];
    }
}
