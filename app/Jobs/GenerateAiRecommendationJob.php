<?php

namespace App\Jobs;

use App\Models\FarmerRequest;
use App\Models\Recommendation;
use App\Services\GeminiAIService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class GenerateAiRecommendationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Number of times the job may be attempted.
     */
    public int $tries = 5;

    /**
     * Timeout in seconds (15 minutes).
     */
    public int $timeout = 900;

    public function __construct(
        protected int $recommendationId
    ) {}

    public function handle(): void
    {
        $rec = Recommendation::find($this->recommendationId);
        if (!$rec) {
            Log::error("GenerateAiRecommendationJob: Recommendation #{$this->recommendationId} not found.");
            return;
        }

        // Mark as processing so the UI can show a spinner
        $rec->update(['ai_status' => 'processing']);

        $farmerRequest = FarmerRequest::with([
            'farmer',
            'farm',
            'farmerRequestSamples',
            'soilSampleResult.soilSample',
        ])->find($rec->request_id);

        if (!$farmerRequest) {
            Log::error("GenerateAiRecommendationJob: FarmerRequest #{$rec->request_id} not found.");
            $rec->update(['ai_status' => 'failed']);
            return;
        }

        $ai   = new GeminiAIService();
        $text = $ai->generateRecommendation($farmerRequest);

        if ($text) {
            $rec->update([
                'ai_text'   => $text,
                'ai_status' => 'pending',
            ]);
            Log::info("GenerateAiRecommendationJob: Success for recommendation #{$this->recommendationId}. Length: " . strlen($text));
        } else {
            $rec->update(['ai_status' => 'failed']);
            Log::error("GenerateAiRecommendationJob: Failed for recommendation #{$this->recommendationId}.");
            // Rethrow to trigger job retry
            throw new \RuntimeException('Gemini API returned no text. Will retry.');
        }
    }

    /**
     * Calculate the number of seconds to wait before retrying.
     */
    public function backoff(): array
    {
        return [10, 30, 60, 120]; // waits 10s, 30s, 60s, 120s between attempts
    }
}
