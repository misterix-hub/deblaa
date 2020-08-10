<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\CategorieTicket;

class Ticket extends Model
{
    use SoftDeletes;
    
    protected $guarded = ['id'];

    public function categorie() {
        return $this->belongsTo(CategorieTicket::class);
    }
}
