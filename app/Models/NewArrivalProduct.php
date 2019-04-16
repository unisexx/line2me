<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewArrivalProduct extends Model
{
    protected $table = 'new_arrival_products';
    protected $fillable = array(
        'new_arrival_id',
        'product_code',
        'product_type',
    );
}
