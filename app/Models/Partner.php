<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $table = 'partners';
    protected $primaryKey = 'partner_id';

    protected $fillable = [ 'user_id', 'name', 'surname', 'address', 'phone', 'email', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id' );
    }


}
