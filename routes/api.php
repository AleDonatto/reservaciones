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
Route::post('appLogin', 'ApiController@loginApp');

Route::get('getAllUnits', 'ApiController@getAllUnits');

Route::get('getUnit/{id}', 'ApiController@getUnit');

Route::get('getallmisreservaciones/{usuario}', 'ApiController@getAllMisReservaciones');

Route::get('getReservacionesRecientes/{usuario}', 'ApiController@getReservacionesRecientes');

Route::get('getReservacion/{id}', 'ApiController@getReservacion');

Route::get('cancelarReservacion/{id}', 'ApiController@cacelarReservacion');

Route::post('modificarReservacion/{id}', 'ApiController@modificarReservacion');

Route::post('buscarMesas','ApiController@getMesasUnidad');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
