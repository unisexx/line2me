<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Emoji extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'emojis';

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
    protected $fillable = array(
        'emoji_code',
        'title',
        'detail',
        'creator_name',
        'threedays',
        'created',
        'updated',
        'category',
        'country',
        'slug',
        'price',
        'status',
    );
    
}
