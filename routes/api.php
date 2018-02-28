<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//rota para pegar as coordenadas
Route::get('coord','ApiController@index');
//rota para gravar uma coordenada
Route::post('coord','ApiController@store');
//rota para logar
Route::post('login','ApiController@authenticate');
//rota para registrar
Route::post('singup','ApiController@singup');
//rota para menor distancia atual ate um objeto
Route::post('shorterDistance', 'ApiCOntroller@shorterDistance');