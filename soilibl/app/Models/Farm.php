<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Farm extends Model
{
    protected $table = 'farms';
    protected $primaryKey = 'farm_id';

    protected $fillable = ['farm_name', 'farmer_id', 'postal_address', 'contact_phone', 'size', 'lat', 'long', 'created_at', 'updated_at'];

    public function farmer()
    {
        return $this->belongsTo(Farmer::class, 'farmer_id', 'farmer_id');
    }


}
