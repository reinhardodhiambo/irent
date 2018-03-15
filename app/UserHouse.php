<?php

namespace App;

use App\Models\Auth\User\User;
use Illuminate\Database\Eloquent\Model;

class UserHouse extends Model
{
    protected $table = 'user_house';
    protected $fillable = ['user_id','house_id'];

    public function user()
    {
        return $this->belongsTo('App\Models\Auth\User\User', 'user_id');
    }

    public function house()
    {
        return $this->belongsTo('App\House', 'house_id');
    }

}
