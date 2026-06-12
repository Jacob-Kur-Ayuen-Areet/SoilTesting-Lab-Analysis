<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$user = App\Models\User::where('email', 'tt@gmail.com')->first();
if ($user) {
    $farmer = App\Models\Farmer::where('user_id', $user->id)->first();
    if ($farmer) {
        App\Models\Farm::firstOrCreate(
            ['farmer_id' => $farmer->farmer_id],
            ['farm_name' => 'Main Farm']
        );
        echo "Default farm created for TT.\n";
    }
}
