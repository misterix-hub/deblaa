<?php

namespace App;

use App\Models\Departement;
use App\Models\Filiere;
use App\Models\Niveau;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'telephone',  'fonction', 'departement_id', 'filiere_id', 'niveau_id', 'acronyme_niveau'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function filiere() {
        return $this->belongsTo(Filiere::class);
    }

    public function departement() {
        return $this->belongsTo(Departement::class);
    }

    public function niveau() {
        return $this->belongsTo(Niveau::class);
    }

}
