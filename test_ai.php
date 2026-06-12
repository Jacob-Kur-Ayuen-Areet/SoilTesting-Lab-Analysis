<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$request = App\Models\FarmerRequest::with(['farmer', 'farm', 'farmerRequestSamples', 'soilSampleResult.soilSample'])->first();
if (!$request) {
    echo "No FarmerRequest found.\n";
    exit(1);
}

echo "Running AI for Request ID: " . $request->request_id . "\n";
echo "Farmer Name: " . ($request->farmer->farmer_name ?? 'N/A') . "\n";

$ai = new App\Services\GeminiAIService();

echo "\n--- GENERATING SOIL ANALYSIS ---\n";
$analysis = $ai->generateSoilAnalysis($request);
echo "Analysis output:\n";
var_dump($analysis);

echo "\n--- GENERATING RECOMMENDATION ---\n";
$recommendation = $ai->generateRecommendation($request);
echo "Recommendation output:\n";
var_dump($recommendation);
