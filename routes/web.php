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

//Route::get('/home/{any}', 'HomeController@index')->name('home')->where('any','.*');

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

Route::post('loginClientes', 'SpecialController@loginClientes')->name('loginClientes');

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

Route::get('getlistaunidades/{id}','SpecialController@getlistaunidades')->name('getlistaunidades')->middleware('auth');
/* fin rutas admintrador*/

/*rutas de socios */
Route::resource('socios_negocios','SociosBusinessUnitController')->only([
    'index','update','destroy','create','store','edit'
])->middleware('auth');

Route::resource('socios_mesas','SociosTablesUnitController')->only([
    'index','update','destroy','create','store','show'
])->middleware('auth');

Route::get('socios_mesas/{any}', 'SociosTablesUnitsController@index')->where('any','.*');

/*Route::get('socios_mesas/{any}/{any}', 'SociosTablesUnitsController@index')->where('any','.*');*/

Route::resource('socios_reservaciones','SociosReservasController')->only([
    'index','store','destroy','create','show','updated'
])->middleware('auth');

Route::get('socios_getListBookings/{id}/{fecha}','SpecialController@getListBookings')->name('getlistbookings')->middleware('auth');

Route::get('consallbookings/{unidad}','SpecialController@consAllReservaciones')->name('getAllBookingsSocios')->middleware('auth');

Route::post('confirmarLlegadaReservacion','SpecialController@confirmarLlegadaReservacion')->name('cofirmarLlegada')->middleware('auth');

Route::post('confirmarAusenciaReservacion','SpecialController@confirmarFaltaReservacion')->name('confirmarAusencia')->middleware('auth');
/* fin rutas de socios*/


/* rutas de clientes */
Route::get('getlistunidades','SpecialController@getListUnidades')->name('getlistunidades')->middleware('auth');

Route::get('getLitsReservaciones', 'SpecialController@getClientesResevaciones')->name('getListBookings')->middleware('auth');

Route::get('getMesasUnidad/{id}', 'SpecialController@getMesasUnidad')->name('getMesasUnidad')->middleware('auth');

Route::post('postReservacion', 'SpecialController@postReservacion')->name('postReservacion')->middleware('auth');

Route::post('buscarMesas', 'SpecialController@postBuscarMesas')->name('postBuscarMesas')->middleware('auth');

Route::get('clientes_reservacion', 'SpecialController@formClientesReservacion')->name('clientes_reservacion')->middleware('auth');

Route::get('cancelarReservacion/{id}', 'SpecialController@cancelarReservacion')->name('cancelarReservacion')->middleware('auth');

Route::get('clients/reservaciones', 'SpecialController@getClientesAllReservaciones')->name('allReservasClients')->middleware('auth');

Route::get('getClienteReservacion/{id}','SpecialController@getAllReservacionCliente')->name('gteClienteReservacion')->middleware('auth');
/* fin rutas clientes*/


