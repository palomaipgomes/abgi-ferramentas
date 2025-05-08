<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Toolbox\Lista;
use App\Http\Livewire\Toolbox\Dados;

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
    return view('welcome');
});


Route::get('/ferramentas', Lista::class);
Route::get('/ferramentas/novo', Dados::class);
Route::get('/ferramentas/{id}/editar', Dados::class);
