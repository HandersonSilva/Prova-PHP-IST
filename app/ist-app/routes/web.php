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

Route::resource('/cliente', 'App\Http\Controllers\PessoaController');
Route::post('/pesquisar', 'App\Http\Controllers\PessoaController@pesquisarCliente');
