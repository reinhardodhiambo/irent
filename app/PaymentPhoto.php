<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentPhoto extends Model
{
    protected $fillable = ['payment_id', 'filename'];

    protected $table = 'payment_photo';

    public function payment()
    {
        return $this->belongsTo('App\Payment','payment_id');

    }
}
