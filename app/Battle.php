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

    public function getAliveArmies()
    {
        return $this->hasMany(Army::class)->where('alive_units', '>', 0);
    }

    public function getRandomArmy(Army $attacker)
    {
        return $this->getAliveArmies()->whereNotIn('id', [$attacker->id])->inRandomOrder()->first();
    }

    public function getWeakestArmy(Army $attacker)
    {
        return $this->getAliveArmies()->whereNotIn('id', [$attacker->id])->orderBy('alive_units', 'ASC')->first();
    }

    public function getStrongestArmy(Army $attacker)
    {
        return $this->getAliveArmies()->whereNotIn('id', [$attacker->id])->orderBy('alive_units', 'DESC')->first();
    }
}
