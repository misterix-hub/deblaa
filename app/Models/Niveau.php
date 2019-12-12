<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Niveau
 * @package App\Models
 * @version December 10, 2019, 12:06 pm UTC
 *
 * @property string nom
 */
class Niveau extends Model
{
    use SoftDeletes;

    public $table = 'niveaux';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'nom'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nom' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nom' => 'required'
    ];

    public function filieres() {
        return $this->belongsToMany(Filiere::class, 'filiere_niveaux');
    }
}
