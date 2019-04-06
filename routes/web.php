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
    return view('auth/login');
});
Route::Auth();
Route::get('register', 'Auth\RegisterController@index')->name('register');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/perfil', 'PerfilController@index')->name('perfil');
    Route::get('/atualizar', 'PerfilController@atualizar')->name('atualizar');
    Route::POST('/perfil/salvar', 'PerfilController@store')->name('perfil.salvar');
});

Route::group(['middleware' => ['auth', 'perfil']], function () {
    Route::resource('avaliacao', 'AvaliacaoQuestionarioController');
    Route::resource('questionario', 'AvaliacaoQuestionarioController');
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::POST('/avaliar/{id}', 'AvaliacaoQuestionarioController@index')->name('avaliar');
    Route::POST('/enviar', 'AvaliacaoQuestionarioController@store')->name('enviar');
    Route::POST('/updateperfil/{id}', 'PerfilController@update')->name('perfil.update');
});

Route::group(['middleware' => ['admin', 'auth']], function () {
    Route::resource('area', 'AreaController');
    Route::resource('qperfil', 'QuestaoPerfil');
    Route::resource('projeto', 'ProjetoController');
    Route::get('/incluir', 'ProjetoController@index')->name('incluir');
    Route::get('/criardiretriz', 'QuestoesController@index')->name('criardiretriz');
    Route::post('/salvardiretriz', 'QuestoesController@store')->name('salvardiretriz');
    Route::get('/selecao', 'GrupoProjetoController@selecao')->name('selecao');
    Route::get('/listardiretriz', 'QuestoesController@listar')->name('listar.diretriz');
    Route::POST('/editardiretriz/{id}', 'QuestoesController@edit')->name('editar.diretriz');
    Route::POST('/updatediretriz/{id}', 'QuestoesController@update')->name('update.diretriz');
    Route::POST('/modal', 'GrupoProjetoController@modal')->name('modal');
    Route::POST('/grafico', 'GrupoProjetoController@grafico')->name('grafico');
    Route::POST('/criar', 'ProjetoController@store')->name('criar');
    Route::get('/atribuir', 'GrupoProjetoController@index')->name('atribuir');
    Route::POST('/salvargrupo', 'GrupoProjetoController@store')->name('salvargrupo');
    Route::POST('/atribuir/{id}', 'GrupoProjetoController@participantes')->name('participantes');
});
