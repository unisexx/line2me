<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promote extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'promotes';

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
        'product_code',
        'product_type',
        'start_date',
        'end_date',
        'email',
    );
    
}
