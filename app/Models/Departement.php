<?php

namespace App\Models;

use App\User;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

/**
 * Class Departement
 * @package App\Models
 * @version December 11, 2019, 3:23 pm UTC
 *
 * @property string nom
 * @property integer structure_id
 */
class Departement extends Model
{
    use SoftDeletes;

    public $table = 'departements';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'nom',
        'structure_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nom' => 'string',
        'structure_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nom' => 'required',
        'structure_id' => 'required'
    ];

    public function structure() {
        return $this->belongsTo(Structure::class);
    }

    public function user() {
        return $this->hasMany(User::class);
    }

    public function pathShow() {
        return url("structures/groupes/{$this->id}-" . Str::slug(Str::random(15) . "-" . $this->nom) . "/details");
    }

    public function pathModifier() {
        return url("structures/groupes/{$this->id}-" . Str::slug(Str::random(15) . "-" . $this->nom) . "/modifier");
    }

    public function pathSupprimer() {
        return url("structures/groupes/{$this->id}-" . Str::slug(Str::random(15) . "-" . $this->nom) . "/supprimer");
    }

    public function pathAddMember() {
        return url("structures/membres/ajouter/{$this->id}-" . Str::slug(Str::random(30)));
    }

    public function pathAddMembersByList() {
        return url("structures/membres/departement-contact/{$this->id}-" . Str::slug(Str::random(30)));
    }
}
