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
Route::get('/', 'HomeController@index');


Route::get('/usuarios','UsuariosController@index');
Route::post('/usuarios','UsuariosController@store');
Route::patch('/usuarios/{usuario}','UsuariosController@update');
Route::delete('/usuarios/{usuario}','UsuariosController@destroy');
Route::get('/usuarios/cadastro','UsuariosController@create');
Route::get('/usuarios/{usuario}/edit','UsuariosController@edit');