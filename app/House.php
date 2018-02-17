<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{

    protected $table = 'houses';
    protected $fillable = ['house_number','apartment_id','bedroom','kitchen','bathroom','toilet','balcony','floor'];

    public function apartment()
    {
        return $this->belongsTo('App\Apartment');
    }
}
