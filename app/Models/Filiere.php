<?php

namespace App\Models;

use App\User;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Filiere
 * @package App\Models
 * @version December 10, 2019, 12:06 pm UTC
 *
 * @property string nom
 * @property integer universite_id
 */
class Filiere extends Model
{
    use SoftDeletes;

    public $table = 'filieres';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'nom',
        'universite_id',
        'acronyme'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nom' => 'string',
        'universite_id' => 'integer',
        'acronyme' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nom' => 'required',
        'universite_id' => 'required',
        'niveaux' => 'required',
        'acronyme' => 'required|min:2|max:10'
    ];

    public function universite() {
        return $this->belongsTo(Universite::class);
    }

    public function niveaux() {
        return $this->belongsToMany(Niveau::class, 'filiere_niveaux');
    }

    public function user() {
        return $this->hasMany(User::class);
    }


}
