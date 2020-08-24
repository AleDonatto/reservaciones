<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth','verified');

Route::get('prueba',function(){
    return view('prueba');
});

Route::get('login_socios',function(){
    return view('login_negocios');
})->name('login_socios');

Route::get('register_socios', function(){
    return view('register_socios');
})->name('register_socios');

Route::get('app_login',function(){
    return view('app_login');
})->name('app_login');            

Route::get('app_register',function(){
    return view('register');
})->name('app_register');

Route::post('registro_socios','SpecialController@RegistroSocios')->name('registro_socios');

Route::post('registro_clientes', 'SpecialController@RegistroClientes')->name('registro_clientes');

/*rutas administrador */
Route::resource('socios','SociosController')->only([
    'index','store','update','create'
])->middleware('auth');

Route::resource('codigos','CodigosController')->only([
    'index','store','update','create'
])->middleware('auth');

Route::resource('negocios','BusinessUnitController')->only([
    'index','create','store','update','destroy','show'
])->middleware('auth');

Route::resource('mesas','TablesController')->only([
    'index','create','store','update','destroy','show'
])->middleware('auth');
/* fin rutas admintrador*/

/*rutas de socios */
Route::resource('socios_negocios','SociosBusinessUnitController')->only([
    'index','update','destroy','create','store','edit'
])->middleware('auth');

Route::resource('socios_mesas','SociosTablesUnitController')->only([
    'index','updated','destroy','create','store','show'
])->middleware('auth');

Route::resource('socios_reservaciones','SociosReservasController')->only([
    'index','store','destroy','create','show','updated'
])->middleware('auth');

Route::get('socios_getListBookings/{id}/{fecha}','SpecialController@getListBookings')->name('getlistbookings')->middleware('auth');
/* fin rutas de socios*/


/* rutas de clientes */
Route::get('getlistunidades','SpecialController@getListUnidades')->name('getlistunidades')->middleware('auth');

Route::get('getLitsReservaciones', 'SpecialController@getClientesResevaciones')->name('getListBookings')->middleware('auth');

Route::get('getMesasUnidad/{id}', 'SpecialController@getMesasUnidad')->name('getMesasUnidad')->middleware('auth');

Route::post('postReservacion', 'SpecialController@postReservacion')->name('postReservacion')->middleware('auth');

/* fin rutas clientes*/


