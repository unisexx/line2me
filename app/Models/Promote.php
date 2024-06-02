<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promote extends Model
{

    protected $table      = 'promotes';
    protected $primaryKey = 'id';
    protected $fillable   = [
        'product_code',
        'product_type',
        'start_date',
        'end_date',
        'email',
    ];

    public function sticker()
    {
        return $this->belongsTo(Sticker::class, 'sticker_code', 'product_code')
        // ->where('product_type', 'sticker')
            ->whereColumn('promotes.product_type', 'sticker');
    }

    // public function sticker()
    // {
    //     return $this->hasone('App\Models\Sticker', 'sticker_code', 'product_code');
    // }

    public function theme()
    {
        return $this->hasone('App\Models\Theme', 'theme_code', 'product_code');
    }

    public function emoji()
    {
        return $this->hasone('App\Models\Emoji', 'emoji_code', 'product_code');
    }

}
