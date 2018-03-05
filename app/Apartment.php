<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    protected $fillable = ['name','description','owner_id','location'];

    public function houses()
    {
        return $this->hasMany('App\House');
    }

    public function repairs(){
        return $this->hasMany('App\Repair');
    }
}
