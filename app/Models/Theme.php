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
    protected $fillable = array('theme_code','name','description','price','head_credit','foot_credit','user_id','status','theme_path','slug','country');
    
}
