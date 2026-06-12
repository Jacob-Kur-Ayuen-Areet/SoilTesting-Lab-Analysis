<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Farmer extends Model
{
    protected $table = 'farmers';
    protected $primaryKey = 'farmer_id';

    protected $fillable = ['user_id', 'country_id', 'province_id', 'district_id', 'email','city_id', 'farmer_name', 'receipt_number', 'postal_address', 'contact_phone', 'created_at', 'updated_at'];

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'city_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'district_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id' );
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'country_id');
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id', 'province_id');
    }
    public function farm()
    {
        return $this->hasMany(Farm::class, 'farmer_id', 'farmer_id');
    }


}
