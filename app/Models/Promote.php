<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promote extends Model
{

    protected $table = 'promotes';
    protected $primaryKey = 'id';
    protected $fillable = array(
        'product_code',
        'product_type',
        'start_date',
        'end_date',
        'email',
    );

    public function sticker(){
        return $this->hasOne('App\Models\Sticker', 'sticker_code', 'product_code');
    }

    public function theme(){
        return $this->belongsTo('App\Models\Theme', 'theme_code', 'product_code');
    }

    public function emoji(){
        return $this->belongsTo('App\Models\Emoji', 'emoji_code', 'product_code');
    }
    
}
