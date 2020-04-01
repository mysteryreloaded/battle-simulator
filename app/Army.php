<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Army extends Model
{
    const RANDOM = 0;
    const WEAKEST = 1;
    const STRONGEST = 2;

    public function battle()
    {
        return $this->belongsTo(Battle::class);
    }
}
