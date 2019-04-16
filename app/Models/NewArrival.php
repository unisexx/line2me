<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewArrival extends Model
{
    protected $table = 'new_arrivals';
    protected $fillable = array('title');

    public function product()
    {
        return $this->hasMany('App\Models\NewArrivalProduct', 'new_arrival_id', 'id');
    }
}
