<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    protected $table = 'series';
    protected $fillable = array('title');

    // this is a recommended way to declare event handlers
    public static function boot() {
        parent::boot();

        static::deleting(function($series) { // before delete() method call this
             $series->seriesItem()->delete();
             // do the rest of the cleanup...
        });
    }

    public function seriesItem()
    {
        return $this->hasMany('App\Models\SeriesItem', 'series_id', 'id')->orderBy('order','asc');
    }
}
