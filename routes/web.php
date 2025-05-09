<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Toolbox\Lista;
use App\Http\Controllers\ExportController;

Route::get('/', function () {
    return view('welcome');
});

// Livewire controla tudo
Route::get('/ferramentas', Lista::class);
Route::get('/ferramentas/exportar', [Lista::class, 'exportarCsv'])->name('ferramentas.exportar');
Route::get('/ferramentas/exportar', [ExportController::class, 'exportar'])->name('ferramentas.exportar');

