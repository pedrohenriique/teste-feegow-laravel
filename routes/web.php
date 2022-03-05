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

Route::get('/', 'ApiController@buscaEspecialidades')->name('index');
Route::get('/busca-profissionais', 'ApiController@buscaProfissionais')->name('buscaProfissionais');
Route::get('/agendamentos', 'ApiController@buscaAgendamentoEspecialidades')->name('buscaAgendamentoEspecialidades');

Route::group(['as' => 'agendamento.'], function () {
    Route::post('/busca-agendamento', 'AgendamentoController@buscaAgendamento')->name('buscaAgendamento');
    Route::post('/cadastro-agendamento', 'AgendamentoController@cadastroAgendamento')->name('cadastroAgendamento');
    Route::delete('/desmarca-agendamento', 'AgendamentoController@desmarcaAgendamento')->name('desmarcaAgendamento');
});
Route::get('/empresa', 'EmpresaController@index')->name('empresa.index');
Route::get('/busca-empresa', 'ApiController@buscaEmpresa')->name('empresa.buscaEmpresa');
