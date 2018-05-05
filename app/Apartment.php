<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Apartment extends Model
{
    use Sortable;
    protected $fillable = ['name','description','owner_id','location'];
    public $sortable = ['name','description','owner_id','location'];

    public function houses()
    {
        return $this->hasMany('App\House');
    }

    public function repairs(){
        return $this->hasMany('App\Repair');
    }
}
