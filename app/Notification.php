<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';
    protected $fillable = ['message','apartment_id','user_id'];

    public function user()
    {
        return $this->belongsTo('App\Models\Auth\User\User', 'user_id');
    }
}
