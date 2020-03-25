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

    public function sticker()
    {
        return $this->hasOne('App\Models\Sticker', 'sticker_code', 'product_code');
    }

    public function emoji()
    {
        return $this->hasOne('App\Models\Emoji', 'emoji_code', 'product_code');
    }

    public function theme()
    {
        return $this->hasOne('App\Models\Theme', 'theme_code', 'product_code');
    }
}
