<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class MessageUniversite extends Model
{
    public function path() {
        return url("universites/messages/{$this->id}-" . Str::slug($this->titre) . "/details");
    }
}
