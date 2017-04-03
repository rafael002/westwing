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

Route::get('/', ['middleware' => 'auth', function () { return view('westwing'); }]);

Route::auth();

Route::get('/home', 'HomeController@index');


//CADASTRO DE CHAMADOS
Route::get('/chamado/novo/', 'CadChamadoController@open');

Route::get('/chamado/novo/simples', 'CadChamadoController@openSimples');

Route::get('/cadastro/confirma/email/','CadChamadoController@getEmail');

Route::get('/cadastro/confirma/pedido/','CadChamadoController@getNumPedido');

Route::get('/cadastro/save/', 'CadChamadoController@save');


//RELATÓRIO
Route::get('/relatorio/','RelatorioController@open');

Route::get('/relatorio/detalhe/','RelatorioController@detalhe');

Route::get('/relatorio/chamado/deletar/','RelatorioController@apagar');

Route::post('/relatorio/filtro/','RelatorioController@filtro');


