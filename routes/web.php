<?php

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/fluxo/detalhar/{id}', 'FluxoController@passagem')->name('fluxo.passagem');
Route::get('/processos/upload/{id}', 'ProcessoController@upload')->name('processo.upload');
Route::get('/fluxo/respondido', 'FluxoController@respondido')->name('fluxo.respondido');

Route::resource('/setor', 'SetorController');
Route::resource('/processos', 'ProcessoController');
Route::resource('/fluxo', 'FluxoController');

