<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Farmer;
use App\Models\Farm;
use App\Models\FarmerRequest;
use App\Models\SoilSample;
use App\Models\SoilSampleResult;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class SystemSecurityAndValidationTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test that staff routes are protected and only role 1 can access them.
     */
    public function test_staff_routes_role_protection()
    {
        // 1. Create a Farmer user (role_id = 2)
        $farmerUser = User::create([
            'name' => 'Test Farmer User',
            'email' => 'testfarmer@soilim.com',
            'phone' => '1234567890',
            'role_id' => 2,
            'password' => bcrypt('password'),
        ]);

        // 2. Create a Staff user (role_id = 1)
        $staffUser = User::create([
            'name' => 'Test Staff User',
            'email' => 'teststaff@soilim.com',
            'phone' => '0987654321',
            'role_id' => 1,
            'password' => bcrypt('password'),
        ]);

        // --- Test 1: Guest tries to access staff route -> Redirected to Login
        $response = $this->get('/soil_sample_results');
        $response->assertRedirect('/login');

        // --- Test 2: Farmer tries to access staff route -> Redirected with warning
        $response = $this->actingAs($farmerUser)->get('/soil_sample_results');
        $response->assertRedirect('/farmer_requests');
        $response->assertSessionHas('error', 'You do not have permission to access this page.');

        // --- Test 3: Staff tries to access staff route -> Success (200)
        $response = $this->actingAs($staffUser)->get('/soil_sample_results');
        $response->assertStatus(200);
    }

    /**
     * Test data validation when storing a farmer request.
     */
    public function test_farmer_request_store_validation()
    {
        $staffUser = User::create([
            'name' => 'Test Staff User',
            'email' => 'teststaff2@soilim.com',
            'phone' => '0987654321',
            'role_id' => 1,
            'password' => bcrypt('password'),
        ]);

        // Attempting to post empty request -> Should fail validation
        $response = $this->actingAs($staffUser)->post(route('farmer_requests.store'), []);
        $response->assertSessionHasErrors(['farmer_id', 'farm_id', 'contact_phone', 'number_of_samples']);
    }

    /**
     * Test validation of lab result entry.
     */
    public function test_soil_sample_result_store_validation()
    {
        $staffUser = User::create([
            'name' => 'Test Staff User',
            'email' => 'teststaff3@soilim.com',
            'phone' => '0987654321',
            'role_id' => 1,
            'password' => bcrypt('password'),
        ]);

        // Attempt to store result with invalid numeric data
        $response = $this->actingAs($staffUser)->post(route('soil_sample_results.store', 1), [
            'request_id' => 1,
            'sample_id' => 1,
            'laboratory_number' => 'LAB-123',
            'ph_cacl2' => 'not-a-number', // Should be numeric
        ]);

        $response->assertSessionHasErrors(['ph_cacl2']);
    }

    /**
     * Test dashboard retrieves monthly data correctly.
     */
    public function test_dashboard_dynamic_data()
    {
        $staffUser = User::create([
            'name' => 'Test Staff User',
            'email' => 'teststaff4@soilim.com',
            'phone' => '0987654321',
            'role_id' => 1,
            'password' => bcrypt('password'),
        ]);

        $response = $this->actingAs($staffUser)->get(route('dashboard'));
        $response->assertStatus(200);
        $response->assertViewHas('monthlyData');
    }

    /**
     * Test that recommendation/create view loads successfully and passes the correct variables.
     */
    public function test_recommendation_create_view_loads_successfully()
    {
        $staffUser = User::create([
            'name' => 'Test Staff User',
            'email' => 'teststaff5@soilim.com',
            'phone' => '0987654321',
            'role_id' => 1,
            'password' => bcrypt('password'),
        ]);

        $farmerUser = User::create([
            'name' => 'Test Farmer User',
            'email' => 'testfarmer5@soilim.com',
            'phone' => '1234567890',
            'role_id' => 2,
            'password' => bcrypt('password'),
        ]);

        $farmer = Farmer::create([
            'user_id' => $farmerUser->id,
            'farmer_name' => 'Test Farmer',
            'contact_phone' => '1234567890',
            'email' => 'testfarmer5@soilim.com',
        ]);

        $farm = Farm::create([
            'farmer_id' => $farmer->farmer_id,
            'farm_name' => 'Main Farm',
        ]);

        $farmerRequest = FarmerRequest::create([
            'farmer_id' => $farmer->farmer_id,
            'farm_id' => $farm->farm_id,
            'contact_phone' => '1234567890',
            'number_of_samples' => 1,
        ]);

        $response = $this->actingAs($staffUser)->get(route('recommendation.create', $farmerRequest->request_id));
        $response->assertStatus(200);
        $response->assertViewHas('farmer_request');
        $response->assertDontSee('Request Not Found !!');
    }

    /**
     * Test that user list route works and restricts non-staff.
     */
    public function test_users_route_protection_and_retrieval()
    {
        $staffUser = User::create([
            'name' => 'Test Staff User',
            'email' => 'teststaff6@soilim.com',
            'phone' => '0987654321',
            'role_id' => 1,
            'password' => bcrypt('password'),
        ]);

        $farmerUser = User::create([
            'name' => 'Test Farmer User',
            'email' => 'testfarmer6@soilim.com',
            'phone' => '1234567890',
            'role_id' => 2,
            'password' => bcrypt('password'),
        ]);

        // Farmer gets blocked and redirected
        $response = $this->actingAs($farmerUser)->get(route('users.index'));
        $response->assertRedirect('/farmer_requests');

        // Staff gets user list
        $response = $this->actingAs($staffUser)->get(route('users.index'));
        $response->assertStatus(200);
        $response->assertViewHas('users');

        // Test search
        $response = $this->actingAs($staffUser)->get(route('users.index', ['search' => 'teststaff6']));
        $response->assertStatus(200);
        $response->assertSee('teststaff6@soilim.com');
    }
}
