<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "SoilSample 34:\n";
echo json_encode(App\Models\SoilSample::find(34), JSON_PRETTY_PRINT);
echo "\n\nFarmerRequest 14:\n";
echo json_encode(App\Models\FarmerRequest::find(14), JSON_PRETTY_PRINT);
echo "\n\nFarmerRequest 34:\n";
echo json_encode(App\Models\FarmerRequest::find(34), JSON_PRETTY_PRINT);
echo "\n";
