<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sticker extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'stickers';

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
        'sticker_code',
        'category',
        'country',
        'title_th',
        'title_en',
        'author_th',
        'author_en',
        'detail',
        'credit',
        'price',
        'version',
        'onsale',
        'validdays',
        'hasanimation',
        'hassound',
        'stickerresourcetype',
        'status',
        'threedays',
        'stamp_start',
        'stamp_end',
    );
    
}
