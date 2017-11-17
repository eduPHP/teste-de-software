<?php

Route::get('/', 'HomeController@index')->middleware('auth');


Route::get('/usuarios','UsuariosController@index');
Route::post('/usuarios','UsuariosController@store');
Route::patch('/usuarios/{usuario}','UsuariosController@update');
Route::delete('/usuarios/{usuario}','UsuariosController@destroy');
Route::get('/usuarios/cadastro','UsuariosController@create');
Route::get('/usuarios/{usuario}/edit','UsuariosController@edit');

Route::post('/login','Auth\LoginController@login');
Route::get('/login','Auth\LoginController@index')->name('login');
Route::post('/logout','Auth\LoginController@logout');
Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')
    ->name('password.reset');
Route::post('/password/reset', 'Auth\ResetPasswordController@reset');
