<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SoilSample extends Model
{
    protected $table = 'soil_samples';
    protected $primaryKey = 'sample_id';

    protected $fillable = ['request_id', 'laboratory_number', 'plot_id', 'sample_reference', 'type_of_previous_crop', 'date_of_ploughing', 'date_planted', 'previous_crop_yield', 'crop', 'crop_to_be_irrigated', 'planting_date', 'plant_pop_per_ha', 'yield_target_kg_per_ha', 'land_size', 'manure_to_be_used', 'fertilizer_to_be_used', 'lat', 'long', 'created_at', 'updated_at'];

    public function plot()
    {
        return $this->belongsTo(Plot::class, 'plot_id', 'plot_id');
    }

    public function farmerRequest()
    {
        return $this->belongsTo(FarmerRequest::class, 'request_id', 'request_id');
    }

    public function soilSampleResult()
    {
        return $this->hasOne(SoilSampleResult::class, 'sample_id', 'sample_id');
    }


}
