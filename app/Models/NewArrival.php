<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewArrival extends Model
{
    protected $table = 'new_arrivals';
    protected $fillable = array('title');
}
