<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plot extends Model
{
    protected $table = 'plot';
    protected $primaryKey = 'plot_id';

    protected $fillable = ['farm_id', 'name', 'size', 'lat', 'long', 'created_at', 'updated_at'];

    public function farm()
    {
        return $this->belongsTo(Farm::class, 'farm_id', 'farm_id');
    }


}
