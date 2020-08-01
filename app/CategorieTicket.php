<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Ticket;

class CategorieTicket extends Model
{
    protected $guarded = ['id'];

    public function tickets() {
        return $this->hasMany(Ticket::class);
    }
}
