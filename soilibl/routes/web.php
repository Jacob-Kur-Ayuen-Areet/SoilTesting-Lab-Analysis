<?php

use App\Http\Controllers\FarmController;
use App\Http\Controllers\FarmerController;
use App\Http\Controllers\FarmerRequestController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\RecommendationController;
use App\Http\Controllers\SoilSampleResultController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|__________________________________________________________________________
| Web Routes
|__________________________________________________________________________
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

// Route::get('/farmer_requests', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::post('/farmers', [FarmerController::class, 'store'])->name('farmers.store');

Route::group(['middleware' => 'auth'], function () {
    // Routes for farmer requests
    Route::get('/', function () {
        return view('welcome');
    });
    
    Route::get('/testme', function () {
        return view('test');
    });
    
    
    Route::get('/wizard', function () {
        return view('wizard');
    });
     
    Route::get('/farmer_requests_samples/{id}', [FarmerRequestController::class, 'farmerRequestSoilsamples'])->name('soilsamples');
    Route::get('/farmer_requests', [FarmerRequestController::class, 'index'])->name('home');
    Route::get('/farmer_requests', [FarmerRequestController::class, 'index'])->name('farmer_requests.index');
    Route::post('/farmer_requests/search', [FarmerRequestController::class, 'search'])->name('farmer_requests.search');
    Route::get('/add_farmer_request', [FarmerRequestController::class, 'add_farmer_request'])->name('farmer_requests.add_request');
    Route::post('/farmer_requests/add_sample', [FarmerRequestController::class, 'saveSoilSample'])->name('farmer_requests.add_sample');
    Route::get('farmer_requests/create/{id?}', [FarmerRequestController::class, 'create'])->name('farmer_requests.create');
    Route::get('farmer_requests/verifyfarmer/{id?}', [FarmerRequestController::class, 'verifyfarmer'])->name('farmer_requests.verifyfarmer');
    Route::post('/farmer_requests', [FarmerRequestController::class, 'store'])->name('farmer_requests.store');
    Route::post('/farmer_requests/update/{id}', [FarmerRequestController::class, 'update'])->name('farmer_requests.update');
    Route::delete('/farmer_requests/{id}', [FarmerRequestController::class, 'destroy'])->name('farmer_requests.destroy');

    // Routes for recommendation files
    Route::get('/recommendation', [RecommendationController::class, 'index'])->name('recommendation.index');
   
    Route::get('/recommendation/download/{id}', [RecommendationController::class, 'downloadFile'])->name('recommendation.download');
    Route::get('/recommendation/create/{id}', [RecommendationController::class, 'create'])->name('recommendation.create');
    Route::post('/recommendation/search', [RecommendationController::class, 'search'])->name('recommendation.search');
    Route::post('/recommendation/upload', [RecommendationController::class, 'upload'])->name('recommendation.upload');
    Route::post('/recommendation/update', [RecommendationController::class, 'update'])->name('recommendation.update');
    Route::delete('/recommendation/{id}', [RecommendationController::class, 'destroy'])->name('recommendation.destroy');

    // Routes for soil sample results
    Route::get('/soil_sample_results', [SoilSampleResultController::class, 'index'])->name('soil_sample_results.index');
    Route::get('/generate_pdf/{id}', [SoilSampleResultController::class, 'generatePdf'])->name('soil_sample_results.generatePdf');
    Route::get('/soil_sample_results/{id}', [SoilSampleResultController::class, 'show'])->name('soil_sample_results.show');
    Route::post('/soil_sample_results/search', [SoilSampleResultController::class, 'search'])->name('soil_sample_results.search');
    Route::post('/soil_sample_results/store/{id}', [SoilSampleResultController::class, 'store'])->name('soil_sample_results.store');
    Route::get('/soil_sample_results/create/{id}', [SoilSampleResultController::class, 'create'])->name('soil_sample_results.create');
    Route::put('/soil_sample_results/{id}', [SoilSampleResultController::class, 'update'])->name('soil_sample_results.update');
    Route::delete('/soil_sample_results/{id}', [SoilSampleResultController::class, 'destroy'])->name('soil_sample_results.destroy');

    // Routes for farmers
    Route::get('/farmers', [FarmerController::class, 'index'])->name('farmers.index');
    Route::get('/farmers/{id}', [FarmerController::class, 'show'])->name('farmers.show');
    Route::get('/farmer/add', [FarmerController::class, 'create'])->name('farmers.create');
    Route::post('/farmer/search', [FarmerController::class, 'search'])->name('farmer.search');
    Route::put('/farmers/{id}', [FarmerController::class, 'update'])->name('farmers.update');
    Route::delete('/farmers/{id}', [FarmerController::class, 'destroy'])->name('farmers.destroy');

    // Routes for Partners
    Route::get('/Partners', [PartnerController::class, 'index'])->name('partners.index');
    Route::get('/Partners/{id}', [PartnerController::class, 'show'])->name('partners.show');
    Route::post('/Partners', [PartnerController::class, 'store'])->name('partners.store');
    Route::put('/Partners/{id}', [PartnerController::class, 'update'])->name('partners.update');
    Route::delete('/Partners/{id}', [PartnerController::class, 'destroy'])->name('partners.destroy');

    // Routes for farms
    Route::get('/farms', [FarmController::class, 'index'])->name('farms.index');
    Route::get('/farms/{id}', [FarmController::class, 'show'])->name('farms.show');
    Route::post('/farms', [FarmController::class, 'store'])->name('farms.store');
    Route::put('/farms/{id}', [FarmController::class, 'update'])->name('farms.update');
    Route::delete('/farms/{id}', [FarmController::class, 'destroy'])->name('farms.destroy');
});
