<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SoilSampleResult extends Model
{
    protected $table = 'soil_sample_results';
    protected $primaryKey = 'result_id';

    protected $fillable = [ 'request_id', 'sample_id', 'laboratory_number', 'lab_user_id', 'ph_cacl2', 'colour', 'texture', 'percentage_sand', 'percentage_silt', 'percentage_clay', 'min_initial_n', 'p2o5_ppm', 'k', 'mg', 'ca', 'zn', 'cu', 'approved', 'approved_by_user_id', 'created_at', 'updated_at'];

    public function soilSample()
    {
        return $this->belongsTo(SoilSample::class, 'sample_id', 'sample_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'approved_by_user_id', 'id');
    }

    public function farmerRequest()
    {
        return $this->belongsTo(FarmerRequest::class, 'request_id', 'request_id');
    }

    public function lab_user()
    {
        return $this->belongsTo(User::class, 'lab_user_id', 'id');
    }


}
