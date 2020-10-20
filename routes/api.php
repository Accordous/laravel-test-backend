<?php

use Illuminate\Http\Request;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//Route::get('/', function () {
 //   return view('welcome');
//});


Route::apiResource('/propriedades','PropriedadeController');


Route::apiResource('/contratos','ContratoController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

