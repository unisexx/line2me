<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'themes';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'theme_code',
        'category',
        'country',
        'title',
        'author',
        'detail',
        'credit',
        'price',
        'slug',
        'status',
        'section',
        'ok',
        'views_last_3_days',
    ];

}
