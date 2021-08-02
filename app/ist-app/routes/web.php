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

Route::get('/', 'App\Http\Controllers\PessoaController@index');

/** Pessoa */
Route::resource('/pessoa', 'App\Http\Controllers\PessoaController');
Route::post('/pesquisar', 'App\Http\Controllers\PessoaController@pesquisar');
Route::get('/pesquisar', 'App\Http\Controllers\PessoaController@index');

/** Contas */
Route::resource('/conta', 'App\Http\Controllers\ContaController');
Route::post('/conta/pesquisar', 'App\Http\Controllers\ContaController@pesquisar');
Route::get('/conta/pesquisar', 'App\Http\Controllers\ContaController@index');
Route::get('/conta/pessoa/{id}', 'App\Http\Controllers\ContaController@getContasPorPessoa');

/** Movimentações */
Route::get('/movimentacao', 'App\Http\Controllers\MovimentacaoController@index');
Route::post('/movimentacao', 'App\Http\Controllers\MovimentacaoController@store');

Route::get('/movimentacao/conta/{id}', 'App\Http\Controllers\MovimentacaoController@getMovimentacaoPorConta');

