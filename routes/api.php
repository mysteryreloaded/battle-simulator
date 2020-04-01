<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// List games
Route::get('/battles', 'BattleController@index');
// Create game
Route::post('/battles', 'BattleController@create');
// Show a game
Route::get('/battles/{battle}', 'BattleController@show');
// Add army to a game
Route::post('/battles/{battle}/add-army', 'BattleController@addArmy');
// Attack
Route::post('/battles/{battle}/attack', 'BattleController@attack');
// Reset
Route::post('/battles/{battle}/reset', 'BattleController@reset');
