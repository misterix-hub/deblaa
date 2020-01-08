<?php

namespace App;

use App\Models\Structure;
use Illuminate\Database\Eloquent\Model;

class DemandeStructure extends Model
{
    public function structure(){
        return $this->belongsTo(Structure::class);
    }
}
