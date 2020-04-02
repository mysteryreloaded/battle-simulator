<?php

namespace App\Http\Controllers;

use App\Army;
use App\Battle;

class BattleController extends Controller
{
    private $winner = null;

    public function index()
    {
        return Battle::orderBy('created_at', 'DESC')->get();
    }

    public function create()
    {
        Battle::create();

        return $this->index();
    }

    public function show(Battle $battle)
    {
        return $battle;
    }

    public function addArmy(Battle $battle)
    {
        $this->validateArmy();

        $army = $battle->armies()->create(request(['name', 'start_units', 'alive_units', 'strategy']));

        return $army;
    }

    public function attack(Battle $battle)
    {
        $armies = $battle->getAliveArmies()->orderBy('created_at', 'DESC')->get()->collect();
        $loggedInfo = [];

        if (($battle->status != Battle::FINISHED) && $battle->armies->count() >= 5) {
            foreach ($armies as $armyTemp) {
                $army = Army::find($armyTemp->id);
                if ($army->is_defeated) {
                    continue;
                }

                $enemy = $army->getEnemy();
                $attackSuccess = $army->attack($enemy);

                $log['attacker'] = $army->name;
                $log['enemy'] = $enemy->name;
                $log['strategy'] = $army->strategy;

                if ($attackSuccess) {
                    $killedUnits = $enemy->alive_units - $army->attack_damage;

                    if ($killedUnits <= 0) {
                        $enemy->alive_units = 0;
                        $enemy->save();
                    } else {
                        $enemy->alive_units = $killedUnits;
                        $enemy->save();
                    }

                    $log['attackSuccess'] = $attackSuccess;
                    $log['damage'] = $army->attack_damage;
                } else {
                    $log['attack'] = $attackSuccess;
                }

                $armies = $battle->getAliveArmies()->orderBy('created_at', 'DESC')->get();
                $battle->status = Battle::IN_PROGRESS;
                $battle->save();

                if ($armies->count() == 1) {
                    $battle->status = Battle::FINISHED;
                    $battle->save();
                }
                array_push($loggedInfo, $log);
            }

            return [
                'battle' => Battle::find($battle->id),
                'loggedInfo' => $loggedInfo,
            ];
        } else if ($battle->status == Battle::FINISHED) {
            $this->winner = Army::where('battle_id', $battle->id)->orderBy('alive_units', 'DESC')->first();
            return [
                'error' => 'Battle is finished -> ' . $this->winner->name . ' is the winner!',
            ];
        } else {
            return [
                'error' => 'Add at least 5 armies in order to start the attack.',
            ];
        }
    }

    public function reset(Battle $battle)
    {
        $armies = $battle->armies;

        foreach ($armies as $army) {
            $army->reset();
        }

        $battle->status = Battle::READY;
        $battle->save();

        return $battle;
    }

    protected function validateArmy()
    {
        return request()->validate([
            'name' => ['required', 'string'],
            'start_units' => ['required', 'integer', 'min:80', 'max:100'],
            'strategy' => ['required', 'integer', 'between:0,2'],
        ]);
    }
}
