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

Route::get('getallreservacionesCliente/{usuario}', 'ApiController@getAllReservacionesCliente');

Route::get('getReservacionesRecientes/{usuario}', 'ApiController@getReservacionesRecientes');

Route::get('cancelarReservacion/{id}', 'ApiController@cacelarReservacion');

Route::post('modificarReservacion', 'ApiController@modificarReservacion');

Route::post('buscarMesas','ApiController@getMesasUnidad');

Route::post('createReservacion', 'ApiController@createBooking');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
