<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->handle(Illuminate\Http\Request::capture());

use App\Services\GeminiAIService;
use App\Models\FarmerRequest;
use Illuminate\Support\Facades\Log;

echo "=== Soilim AI Generation Test ===" . PHP_EOL . PHP_EOL;

// Get first available FarmerRequest with all relations
$req = FarmerRequest::with([
    'farmer',
    'farm',
    'farmerRequestSamples',
    'soilSampleResult.soilSample'
])->first();

if (!$req) {
    echo "ERROR: No FarmerRequest found in the database." . PHP_EOL;
    exit(1);
}

echo "Request ID    : " . $req->request_id . PHP_EOL;
echo "Farmer        : " . ($req->farmer->farmer_name ?? 'N/A') . PHP_EOL;
echo "Farm          : " . ($req->farm->farm_name ?? 'N/A') . PHP_EOL;
echo "Samples       : " . $req->farmerRequestSamples->count() . PHP_EOL;
echo "Lab Results   : " . $req->soilSampleResult->count() . PHP_EOL;
echo PHP_EOL;

$ai = new GeminiAIService();

echo "Calling Gemini API... (this may take up to 2 minutes)" . PHP_EOL;
$start = microtime(true);
$text = $ai->generateRecommendation($req);
$elapsed = round(microtime(true) - $start, 2);

echo PHP_EOL;
echo "=== RESULT ===" . PHP_EOL;
echo "Time taken    : {$elapsed}s" . PHP_EOL;
echo "Output length : " . strlen($text ?? '') . " characters" . PHP_EOL;
echo PHP_EOL;

if ($text) {
    echo "STATUS: SUCCESS" . PHP_EOL;
    echo PHP_EOL . "--- First 2000 chars of output ---" . PHP_EOL;
    echo substr($text, 0, 2000) . PHP_EOL;
    echo "--- [" . strlen($text) . " total chars] ---" . PHP_EOL;
} else {
    echo "STATUS: FAILED - Output was null. Check storage/logs/laravel.log" . PHP_EOL;
}
