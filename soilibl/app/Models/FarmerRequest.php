<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FarmerRequest extends Model
{
    protected $table = 'farmer_requests';
    protected $primaryKey = 'request_id';

    protected $fillable = ['farmer_id', 'farm_id', 'receipt_number', 'postal_address', 'contact_phone', 'number_of_samples', 'earliest_date_of_collection', 'farm_name', 'date_received', 'date_sampled', 'ica_locality', 'email', 'advisor_name', 'approved', 'average_sub_samples_taken', 'created_at', 'updated_at'];

    public function farmer()
    {
        return $this->belongsTo(Farmer::class, 'farmer_id', 'farmer_id');
    }
    public function farm()
    {
        return $this->belongsTo(Farm::class, 'farm_id', 'farm_id');
    }
    public function plot()
    {
        return $this->belongsTo(Plot::class, 'plot_id', 'plot_id');
    }

    public function farmerRequestSamples()
    {
        return $this->hasMany(SoilSample::class, 'request_id', 'request_id');
    }
    public function farmerSampleRecRequest()
    {
        return $this->hasOne(Recommendation::class, 'request_id', 'request_id');
    }

    public function soilSampleResult()
    {
        return $this->hasMany(SoilSampleResult::class, 'request_id', 'request_id');
    }

}
