<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Toolbox\Lista;

Route::get('/', function () {
    return view('welcome');
});

// Rota única para o módulo de ferramentas com tudo via modal
Route::view('/ferramentas', 'ferramentas.index');
