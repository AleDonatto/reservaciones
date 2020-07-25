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

Route::get('app_login',function(){
    return view('app_login');
})->name('app_login');            

Route::get('app_register',function(){
    return view('register');
})->name('app_register');

Route::resource('socios','SociosController')->only([
    'index','store','update','create','destroy'
])->middleware('auth');

Route::resource('codigos','CodigosController')->only([
    'index','store','update','create'
])->middleware('auth');

