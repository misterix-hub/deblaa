<?php

namespace App;

use App\Models\Universite;
use Illuminate\Database\Eloquent\Model;

class DemandeUniversite extends Model
{
    public function universite(){
        return $this->belongsTo(Universite::class);
    }
}
