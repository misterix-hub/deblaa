<?php

namespace App\Models;

use App\DemandeUniversite;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Universite
 * @package App\Models
 * @version December 10, 2019, 12:48 pm UTC
 *
 * @property string nom
 * @property string sigle
 * @property string logo
 * @property string telephone
 * @property string email
 * @property string password
 * @property string site_web
 * @property boolean acces
 */
class Universite extends Model
{
    use SoftDeletes;

    public $table = 'universites';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'nom',
        'sigle',
        'logo',
        'telephone',
        'email',
        'password',
        'site_web',
        'acces'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nom' => 'string',
        'sigle' => 'string',
        'logo' => 'string',
        'telephone' => 'string',
        'email' => 'string',
        'password' => 'string',
        'site_web' => 'string',
        'acces' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nom' => 'required',
        'sigle' => 'required',
        'telephone' => 'required',
        'email' => 'required',
        'password' => 'sometimes',
        'acces' => 'required'
    ];


    public function getAccesAttribute($attribute) {
        return [
            0 => 'Banni',
            1 => 'Autorisé',
        ][$attribute];
    }

    public function filieres() {
        return $this->hasMany(Filiere::class);
    }

    public function demande_universites() {
        return $this->hasMany(DemandeUniversite::class);
    }

    
}
