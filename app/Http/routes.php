<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//rotas que necessitam de autenticação.

Route::group(['prefix' => '','middleware' => 'auth'],function (){
    Route::get('perfil',['uses' => 'UserController@perfil', 'as' => 'privadas.perfil']);
    Route::get('dashboard/{organization}',['uses' => 'OrganizationController@dashboard', 'as' => 'organization.dashboard']);
    Route::get('cep',['uses' => 'CepController@getAddressByCep', 'as' => 'privadas.cep']);
    Route::post('usuario-atualizar-perfil',["uses" => 'UserController@update','as' => 'privadas.usuario-atualizar-perfil']);
});

//Auxiliares


//Públicas

Route::get('/', ['uses' => 'PublicController@home', 'as' => 'publicas.home']);
Route::get('contato',['uses' => 'PublicController@contato', 'as' => 'publicas.contato']);
Route::post('contato',['uses' => 'PublicController@postContato', 'as' => 'publicas.postContato']);
Route::get('sobre', ['uses' => 'PublicController@sobre', 'as' => 'publicas.sobre']);
Route::get('suporte',['uses' => 'PublicController@suporte','as' => 'publicas.suporte']);
Route::get('trabalhe-conosco',['uses' => 'PublicController@trabalheConosco','as' => 'publicas.trabalheConosco']);
Route::get('planos-precos', ['uses' => 'PublicController@planosEPrecos','as' => 'publicas.planosEPrecos']);
Route::post('ppContato',['uses' => 'PublicController@PPContato', 'as' => 'publicas.ppContato']);
Route::post('planos-precos',['uses' => 'PublicController@postPlanosPrecos', 'as' => 'publicas.postPlanosPrecos']);

//Registro e autenticação

// Authentication routes...
Route::get('cadastro',['middleware' => 'guest','uses' => 'PublicController@cadastro', 'as' => 'publicas.cadastro']);
Route::get('login', ['middleware' => 'guest','uses' => 'PublicController@login', 'as' => 'publicas.login']);

Route::post('login', 'UserController@postLogin');
Route::get('logout', 'UserController@getLogout');

// Registration routes...
Route::post('cadastrar', 'UserController@postRegister');

//Social Login
Route::get('/login/{provider?}',['uses' => 'UserController@getSocialAuth', 'as' => 'auth.getSocialAuth']);

Route::get('/login/callback/{provider?}',['uses' => 'UserController@getSocialAuthCallback', 'as' => 'auth.getSocialAuthCallback']);

