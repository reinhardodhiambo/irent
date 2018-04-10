<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RepairPhoto extends Model
{
    protected $fillable = ['repair_id', 'filename'];

    protected $table = 'repair_photo';

    public function repair()
    {
        return $this->belongsTo('App\Repair','repair_id');

    }
}
