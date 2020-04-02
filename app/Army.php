<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Army extends Model
{
    const RANDOM = 0;
    const WEAKEST = 1;
    const STRONGEST = 2;

    private const ATTACK_DAMAGE = 0.5; // Points per unit. Every whole point removes 1 unit from the army
    private const ATTACK_CHANCE = 1; // Percentage per every alive unit in the army

    protected $fillable = ['name', 'start_units', 'alive_units', 'strategy'];
    protected $appends = ['attack_chance', 'attack_damage', 'is_defeated'];

    protected static function booted()
    {
        static::created(function ($army) {
            $army->alive_units = $army->start_units;
        });
    }

    public function battle()
    {
        return $this->belongsTo(Battle::class);
    }

    public function getAttackChanceAttribute()
    {
        return static::ATTACK_CHANCE * $this->alive_units;
    }

    public function getAttackDamageAttribute()
    {
        return ceil(static::ATTACK_DAMAGE * $this->alive_units);
    }

    public function getIsDefeatedAttribute()
    {
        return $this->alive_units < 1;
    }

    public function getEnemy()
    {
        switch ($this->strategy) {
            default:
            case static::RANDOM:
                $enemy = $this->battle->getRandomArmy($this);
                break;

            case static::WEAKEST:
                $enemy = $this->battle->getWeakestArmy($this);
                break;

            case static::STRONGEST:
                $enemy = $this->battle->getStrongestArmy($this);
                break;
        }

        return $enemy;
    }

    public function attack(Army $enemy)
    {
        if ($this->attack_chance > mt_rand(0, 99)) {
            return true;
        } else {
            return false;
        }
    }

    public function reset()
    {
        $this->alive_units = $this->start_units;
        $this->save();
    }
}
