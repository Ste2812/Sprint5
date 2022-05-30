<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\PassportAuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Passport;

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

    Route::post('/register',[PassportAuthController::class, 'register']);//rutas publicas
    Route::post('/login',[PassportAuthController::class, 'login']);
    Route::post('/logout',[PassportAuthController::class, 'logout']);

    Route::middleware('auth:api')->group(function () {
        Route::get('/players', [Usercontroller::class, 'getAll']); //rutas privilegio admin
        Route::get('/players/{id}/games', [Usercontroller::class, 'getGames']);
        Route::get('/players/{id}/ranking', [Usercontroller::class, 'getRanking']);
        Route::get('/players/{id}/ranking/loser', [Usercontroller::class, 'getRankingLoser']);
        Route::get('/players/{id}/ranking/winner', [Usercontroller::class, 'getRankingWinner']);

    });
    Route::group(['middleware' => ['role:user']], function () {
        //rutas accesibles solo para clientes
        Route::post('/players', [UserController::class, 'store']);//rutas publicas
        Route::put('/players/{id}/', [UserController::class, 'update']);
        Route::post('/players/{id}/games', [Usercontroller::class, 'addGame']);
        Route::delete('/players/{id}/games', [Usercontroller::class, 'deleteGame']);
    });

    Route::group(['middleware' => ['role:admin']], function () {
        //rutas accesibles solo para admin
        Route::get('/players/{id}', [UserController::class, 'show']);//rutas publicas
        Route::delete('/players/{id}', [UserController::class, 'destroy']);
    });










