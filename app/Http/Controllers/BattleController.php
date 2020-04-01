<?php

namespace App\Http\Controllers;

use App\Battle;

class BattleController extends Controller
{
    public function index()
    {
        return Battle::orderBy('created_at', 'DESC')->get();
    }

    public function create()
    {
        Battle::create();

        return Battle::orderBy('created_at', 'DESC')->get();
    }

    public function show(Battle $battle)
    {
        return $battle;
    }

    public function addArmy(Battle $battle)
    {
        // WIP
    }

    public function attack(Battle $battle)
    {
        // WIP
    }

    public function reset(Battle $battle)
    {
        // WIP
    }
}
