<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CategorieTicket;

class Ticket extends Model
{
    protected $guarded = ['id'];

    public function categorie() {
        return $this->belongsTo(CategorieTicket::class);
    }
}
