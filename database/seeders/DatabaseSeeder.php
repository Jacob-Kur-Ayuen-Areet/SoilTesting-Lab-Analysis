<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert records into the users table first
        DB::table('users')->insert([
            'name' => 'User Name',
            'email' => 'user@example.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Insert records into the countries table
        DB::table('countries')->insert([
            'name' => 'Country Name',
            'code' => 12345,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Insert records into the cities table
        DB::table('cities')->insert([
            'country_id' => 1,
            'city_name' => 'City Name',
            'district_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('provinces')->insert([
            'name' => 'District Name',
            'country_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Insert records into the districts table
        DB::table('districts')->insert([
            'district_name' => 'District Name',
            'province_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Insert records into the farmers table
        DB::table('farmers')->insert([
            'user_id' => 1,
            'country_id' => 1,
            'province_id' => 1,
            'district_id' => 1,
            'city_id' => 1,
            'farmer_name' => 'Farmer Name',
            'receipt_number' => 'Receipt Number',
            'postal_address' => 'Postal Address',
            'contact_phone' => 'Contact Phone',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Insert records into the farms table
        DB::table('farms')->insert([
            'farm_name' => 'Farm Name',
            'farmer_id' => 1,
            'postal_address' => 'Postal Address',
            'contact_phone' => 'Contact Phone',
            'size' => 'Farm Size',
            'lat' => 'Latitude',
            'long' => 'Longitude',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Insert records into the plot table
        DB::table('plot')->insert([
            'farm_id' => 1,
            'name' => 'Plot Name',
            'size' => 'Plot Size',
            'lat' => 'Latitude',
            'long' => 'Longitude',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
         // Insert records into the staff table
         DB::table('staff')->insert([
            'user_id' => 1,
            'name' => 'Staff Name',
            'surname' => 'Staff Surname',
            'address' => 'Staff Address',
            'phone' => 'Staff Phone',
            'email' => 'staff@example.com',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Insert records into the farmer_requests table
        DB::table('farmer_requests')->insert([
            'farmer_id' => 1,
            'farm_id' => 1,
            'receipt_number' => 'Receipt Number',
            'postal_address' => 'Postal Address',
            'contact_phone' => 'Contact Phone',
            'number_of_samples' => 5,
            'earliest_date_of_collection' => now(),
            'farm_name' => 'Farm Name',
            'date_received' => now(),
            'date_sampled' => now(),
            'ica_locality' => 'ICA Locality',
            'email' => 'email@example.com',
            'advisor_name' => 'Advisor Name',
            'approved' => 'Y',
            'average_sub_samples_taken' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Insert records into the partners table
        DB::table('partners')->insert([
            'user_id' => 1,
            'name' => 'Partner Name',
            'surname' => 'Partner Surname',
            'address' => 'Partner Address',
            'phone' => 'Partner Phone',
            'email' => 'partner@example.com',
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        // Insert records into the recommendations table
        DB::table('recommendations')->insert([
            'request_id' => 1,
            'partner_id' => 1,
            'file_path' => 'File Path',
            'approved' => 'Y',
            'notes' => 'Recommendation Notes',
            'uploaded_date' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Insert records into the soil_samples table
        DB::table('soil_samples')->insert([
            'request_id' => 1,
            'laboratory_number' => 'Lab Number',
            'plot_id' => 1,
            'sample_reference' => 'Sample Reference',
            'type_of_previous_crop' => 'Crop Type',
            'date_of_ploughing' => now(),
            'date_planted' => now(),
            'previous_crop_yield' => 'Crop Yield',
            'crop' => 'Crop',
            'crop_to_be_irrigated' => 'Y',
            'planting_date' => now(),
            'plant_pop_per_ha' => 100,
            'yield_target_kg_per_ha' => 'Yield Target',
            'land_size' => 'Land Size',
            'manure_to_be_used' => 'Y',
            'fertilizer_to_be_used' => 'Y',
            'lat' => 'Latitude',
            'long' => 'Longitude',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Insert records into the soil_sample_results table
        DB::table('soil_sample_results')->insert([
            'request_id' => 1,
            'sample_id' => 1,
            'laboratory_number' => 'Lab Number',
            'lab_user_id' => 1,
            'ph_cacl2' => 6.5,
            'colour' => 'Soil Color',
            'texture' => 'Soil Texture',
            'percentage_sand' => 40,
            'percentage_silt' => 30,
            'percentage_clay' => 30,
            'min_initial_n' => 0.5,
            'p2o5_ppm' => 20.5,
            'k' => 150,
            'mg' => 30,
            'ca' => 150,
            'zn' => 2,
            'cu' => 0.5,
            'approved' => 'Y',
            'approved_by_user_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

       
        // Insert data into other tables similarly...

    }
}
