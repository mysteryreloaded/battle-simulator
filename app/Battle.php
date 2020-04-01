<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Battle extends Model
{
    const READY = 0;
    const IN_PROGRESS = 1;
    const FINISHED = 2;

    protected $with = ['armies'];

    public function armies()
    {
        return $this->hasMany(Army::class)->orderBy('created_at', 'DESC');
    }
}
