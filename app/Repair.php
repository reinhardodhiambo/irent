<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Repair extends Model
{
    protected $table = 'repairs';
    protected $fillable = ['name','description','apartment_id','user_id'];

    public function photos()
    {
        return $this->hasMany('App\RepairPhoto');
    }

    public function apartment()
    {
        return $this->belongsTo('App\Apartment', 'apartment_id');
    }

}
