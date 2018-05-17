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
        return $this->belongsTo('App\Models\Auth\User\User', 'user_id','id');
    }

    public function house()
    {
        return $this->belongsTo('App\House', 'house_id','id');
    }

    public static function is_vacant($house_id){
        $houses = UserHouse::where('house_id',$house_id)->where('user_id','!=',0)->first();
        if($houses)
            return false;
        else
            return true;
    }

}
