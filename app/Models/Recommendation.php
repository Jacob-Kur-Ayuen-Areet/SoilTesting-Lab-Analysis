<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recommendation extends Model
{
    protected $table = 'recommendations';
    protected $primaryKey = 'reco_id';

    protected $fillable = ['request_id','sample_id', 'partner_id', 'file_path', 'approved', 'notes', 'ai_text', 'ai_status', 'uploaded_date', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'partner_id', 'id');
    }

    public function farmerRequest()
    {
        return $this->belongsTo(SoilSample::class, 'sample_id', 'sample_id');
    }
    public function farmerSampleRecRequest()
    {
        return $this->hasOne(FarmerRequest::class, 'request_id', 'request_id');
    }

}
