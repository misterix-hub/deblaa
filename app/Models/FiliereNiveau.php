<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class FiliereNiveau
 * @package App\Models
 * @version December 10, 2019, 5:29 pm UTC
 *
 * @property integer filiere_id
 * @property integer niveau_id
 */
class FiliereNiveau extends Model
{
    use SoftDeletes;

    public $table = 'filiere_niveaux';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'filiere_id',
        'niveau_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'filiere_id' => 'integer',
        'niveau_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'filiere_id' => 'required',
        'niveau_id' => 'required'
    ];

    public function filiere() {
        return $this->belongsTo(Filiere::class);
    }

    public function niveau() {
        return $this->belongsTo(Niveau::class);
    }

    
}
