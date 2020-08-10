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
Route::resource('socios/negocios','SociosBusinessUnitController')->only([
    'index','updated','destroy','create'
])->middleware('auth');

Route::resource('socios/mesas','SociosTablesUnitController')->only([
    'index','updated','destroy','create'
])->middleware('auth');
/* fin rutas de socios*/


/* rutas de clientes */

/* fin rutas clientes*/


