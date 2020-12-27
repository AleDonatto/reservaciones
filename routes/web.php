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
Route::get('profile', 'SpecialController@profileUser')->name('profileUser')->middleware('auth');

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
Route::get('getAdminUsuariosUnidad','SpecialController@getAdminUsuariosUnidad')->name('getAdminUsuariosUnidad')->middleware('auth');
Route::get('admin/usuarios_unidad', 'SpecialController@viewAdminUserUnits')->name('viewAdminUserUnits')->middleware('auth');
Route::get('admin/formreservaciones', 'SpecialController@adminFormReservacion')->name('adminFormReservacion')->middleware('auth');
Route::get('admin/misreservaciones', 'SpecialController@getAdminReservaciones')->name('adminMisReservaciones')->middleware('auth');
Route::get('admin/all_bookings', 'SpecialController@adminAllBookings')->name('adminAllReservaciones')->middleware('auth');
Route::get('admin/user_admin','SpecialController@userAdministrador')->name('userAdministrador')->middleware('auth');
Route::post('createUserAdmin', 'SpecialController@createUserAdmin')->name('createUserAdmin')->middleware('auth');
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
    'index','store','create','show','update'
])->middleware('auth');

Route::get('usuarios_unidad','SpecialController@usuariosUnidad')->name('usuariosUnidad')->middleware('auth');
Route::get('getUsuariosUnidad', 'SpecialController@getUsuariosUnidad')->name('getUsuariosUnidad')->middleware('auth');
Route::post('usuariosunidad_store', 'SpecialController@usuariosUnidadStore')->name('usuariosunidad_store')->middleware('auth');
Route::get('cliente_unidad','SpecialController@clienteUnidad')->name('clienteUnidad')->middleware('auth');
Route::get('socios_getListBookings/{id}/{fecha}','SpecialController@getListBookings')->name('getlistbookings')->middleware('auth');
Route::post('consallbookings','SpecialController@consAllReservaciones')->name('getAllBookingsSocios')->middleware('auth');
Route::post('confirmarLlegadaReservacion','SpecialController@confirmarLlegadaReservacion')->name('cofirmarLlegada')->middleware('auth');
Route::post('confirmarAusenciaReservacion','SpecialController@confirmarFaltaReservacion')->name('confirmarAusencia')->middleware('auth');
Route::get('socios_misreservaciones', 'SpecialController@getUsersReservaciones')->name('getUsersReservaciones')->middleware('auth');
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

Route::get('getDatosUserProfile', 'SpecialController@getDatosUserProfile')->name('getDatosUserProfile')->middleware('auth');
Route::post('updateDatosProfile', 'SpecialController@updateDatosUserProfile')->name('updateDatosProfile')->middleware('auth');
Route::post('updatePassword', 'SpecialController@updatePassword')->name('updatePassword')->middleware('auth');

/* rutas usurios de unidad de negocio*/
Route::get('user_unit/unidad', 'UserUnitsController@viewUnidad')->name('viewUnidadUser')->middleware('auth');
Route::get('user_unit/mesas/create', 'UserUnitsController@viewFormMesas')->name('viewFormMesasUserUnits')->middleware('auth');
Route::get('user_units/mesas','UserUnitsController@viewConsultaMesas')->name('viewConsMesasUserUnits')->middleware('auth');
Route::get('user_units/reservaciones', 'UserUnitsController@viewFormReservaciones')->name('viewFormReservacionesUserUnits')->middleware('auth');
Route::get('user_units/cons/reservaciones', 'UserUnitsController@viewConsReservaciones')->name('viewConsReservacionesUserUnit')->middleware('auth');
/* fin rutas usuarios de unidad de negocio*/