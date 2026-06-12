<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$sample = App\Models\SoilSample::where('sample_id', 34)
    ->with('farmerRequest', 'farmerRequest.farmerSampleRecRequest', 'farmerRequest.farmer', 'farmerRequest.farm')
    ->with('soilSampleResult')
    ->select('request_id', 'sample_id', 'laboratory_number', 'plot_id', 'sample_reference')
    ->first();
echo "request_id is: " . var_export($sample->request_id, true) . "\n";
echo "route: " . route('soil_sample_results.generatePdf', $sample->request_id) . "\n";
