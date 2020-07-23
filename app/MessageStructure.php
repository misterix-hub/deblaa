<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class MessageStructure extends Model
{
    public function pathDetails() {
        return url("structures/messages/{$this->id}-" . Str::slug(Str::random(20) . "-" . $this->titre) . "/details");
    }
}
