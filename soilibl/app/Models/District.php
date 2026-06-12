<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'districts';
    protected $primaryKey = 'district_id';

    protected $fillable = ['district_name', 'province_id', 'created_at', 'updated_at'];

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id', 'province_id');
    }


}
