<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeriesItem extends Model
{
    protected $table = 'series_items';
    public $timestamps = false;
    protected $fillable = array(
        'series_id',
        'product_code',
        'product_type',
    );
}
