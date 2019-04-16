<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StickerView extends Model
{
    protected $fillable = array(
        'sticker_id',
        'session_id',
        'ip',
        'created',
    );
}
