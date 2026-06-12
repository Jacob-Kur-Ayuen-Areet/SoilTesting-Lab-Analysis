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

Route::post('/farmers', [FarmerController::class, 'store'])->name('farmers.store');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    // Shared routes for both Farmer and Staff
    Route::get('/', function () {
        return redirect()->route('dashboard');
    });
    Route::get('/testme', function () {
        return view('test');
    });
     
    Route::get('/farmer_requests_samples/{id}', [FarmerRequestController::class, 'farmerRequestSoilsamples'])->name('soilsamples');
    Route::get('/farmer_requests', [FarmerRequestController::class, 'index'])->name('home');
    Route::get('/farmer_requests', [FarmerRequestController::class, 'index'])->name('farmer_requests.index');
    Route::match(['get', 'post'], '/farmer_requests/search', [FarmerRequestController::class, 'search'])->name('farmer_requests.search');
    Route::get('/add_farmer_request', [FarmerRequestController::class, 'add_farmer_request'])->name('farmer_requests.add_request');
    Route::get('farmer_requests/create/{id?}', [FarmerRequestController::class, 'create'])->name('farmer_requests.create');
    Route::get('farmer_requests/{id}/edit', [FarmerRequestController::class, 'create'])->name('farmer_requests.edit');
    Route::get('farmer_requests/verifyfarmer/{id?}', [FarmerRequestController::class, 'verifyfarmer'])->name('farmer_requests.verifyfarmer');
    Route::post('/farmer_requests', [FarmerRequestController::class, 'store'])->name('farmer_requests.store');
    // Both farmers and staff can submit soil samples
    Route::post('/farmer_requests/add_sample', [FarmerRequestController::class, 'saveSoilSample'])->name('farmer_requests.add_sample');
    Route::delete('/farmer_requests/sample/{id}', [FarmerRequestController::class, 'destroySoilSample'])->name('farmer_requests.delete_sample');
    
    // Farmers can download recommendation and generate PDF
    Route::get('/recommendation/download/{id}', [RecommendationController::class, 'downloadFile'])->name('recommendation.download');
    Route::get('/generate_pdf/{id}', [SoilSampleResultController::class, 'generatePdf'])->name('soil_sample_results.generatePdf');
    
    // Farmer profile view route
    Route::get('/farmers', [FarmerController::class, 'index'])->name('farmers.index');
    Route::get('/my-profile', [FarmerController::class, 'myProfile'])->name('farmer.profile');
    Route::get('/my-profile/edit', [FarmerController::class, 'editProfile'])->name('farmer.profile.edit');
    Route::post('/my-profile/update', [FarmerController::class, 'updateProfile'])->name('farmer.profile.update');

    // Menu links for Soil Analysis and Recommendations (farmers will be redirected to their request)
    Route::get('/recommendation', [RecommendationController::class, 'index'])->name('recommendation.index');
    Route::get('/soil_sample_results', [SoilSampleResultController::class, 'index'])->name('soil_sample_results.index');

    // Routes for farms (Shared so farmers can add their own)
    Route::get('/farms', [FarmController::class, 'index'])->name('farms.index');
    Route::get('/farms/{id}', [FarmController::class, 'show'])->name('farms.show');
    Route::post('/farms', [FarmController::class, 'store'])->name('farms.store');
    Route::put('/farms/{id}', [FarmController::class, 'update'])->name('farms.update');
    Route::delete('/farms/{id}', [FarmController::class, 'destroy'])->name('farms.destroy');

    // STAFF ONLY ROUTES
    Route::group(['middleware' => ['role:1']], function () {
        Route::get('/wizard', function () {
            return view('wizard');
        });
        
        Route::post('/farmer_requests/update/{id}', [FarmerRequestController::class, 'update'])->name('farmer_requests.update');
        Route::delete('/farmer_requests/{id}', [FarmerRequestController::class, 'destroy'])->name('farmer_requests.destroy');

        // Routes for recommendation files
        Route::get('/recommendation/create/{id}', [RecommendationController::class, 'create'])->name('recommendation.create');
        Route::get('/recommendation/{id}', [RecommendationController::class, 'show'])->name('recommendation.show');
        Route::post('/recommendation/search', [RecommendationController::class, 'search'])->name('recommendation.search');
        Route::post('/recommendation/upload', [RecommendationController::class, 'upload'])->name('recommendation.upload');
        Route::post('/recommendation/update', [RecommendationController::class, 'update'])->name('recommendation.update');
        Route::delete('/recommendation/{id}', [RecommendationController::class, 'destroy'])->name('recommendation.destroy');
        // AI routes for recommendations
        Route::post('/recommendation/{id}/ai-recommend', [RecommendationController::class, 'generateAiRecommendation'])->name('recommendation.ai.recommend');
        Route::get('/recommendation/{id}/ai-status', [RecommendationController::class, 'statusAiRecommendation'])->name('recommendation.ai.status');
        Route::post('/recommendation/{id}/ai-approve', [RecommendationController::class, 'approveAiRecommendation'])->name('recommendation.ai.approve');
        Route::post('/recommendation/{id}/ai-reject', [RecommendationController::class, 'rejectAiRecommendation'])->name('recommendation.ai.reject');

        // Routes for soil sample results
        Route::get('/soil_sample_results/search', [SoilSampleResultController::class, 'index'])->name('soil_sample_results.search');
        Route::get('/soil_sample_results/{id}', [SoilSampleResultController::class, 'show'])->name('soil_sample_results.show');
        Route::post('/soil_sample_results/search', [SoilSampleResultController::class, 'search']);
        Route::post('/soil_sample_results/store/{id}', [SoilSampleResultController::class, 'store'])->name('soil_sample_results.store');
        Route::get('/soil_sample_results/create/{id}', [SoilSampleResultController::class, 'create'])->name('soil_sample_results.create');
        Route::put('/soil_sample_results/{id}', [SoilSampleResultController::class, 'update'])->name('soil_sample_results.update');
        Route::delete('/soil_sample_results/{id}', [SoilSampleResultController::class, 'destroy'])->name('soil_sample_results.destroy');
        // AI routes for soil analysis
        Route::post('/soil_sample_results/{id}/ai-analyze', [SoilSampleResultController::class, 'generateAiAnalysis'])->name('soil_sample_results.ai.analyze');
        Route::get('/soil_sample_results/{id}/ai-status', [SoilSampleResultController::class, 'statusAiAnalysis'])->name('soil_sample_results.ai.status');
        Route::post('/soil_sample_results/{id}/ai-approve', [SoilSampleResultController::class, 'approveAiAnalysis'])->name('soil_sample_results.ai.approve');
        Route::post('/soil_sample_results/{id}/ai-reject', [SoilSampleResultController::class, 'rejectAiAnalysis'])->name('soil_sample_results.ai.reject');

        // Route to view a single farmer profile
        Route::get('/farmers/{id}', [FarmerController::class, 'show'])->name('farmers.show');
        // Existing farmer routes
        Route::get('/farmers/{id}/edit', [FarmerController::class, 'edit'])->name('farmers.edit');
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


        // Routes for users
        Route::get('/users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
        Route::get('/users/{id}', [\App\Http\Controllers\UserController::class, 'show'])->name('users.show');
    });
});
