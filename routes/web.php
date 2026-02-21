<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\MarcaWebController;

Route::get('/', function () {
    return view('welcome');
});

// CRUD Web - Marcas (Interfaz)
Route::get('/marcas', [MarcaWebController::class, 'index'])->name('marcas.index');
Route::get('/marcas/create', [MarcaWebController::class, 'create'])->name('marcas.create');
Route::post('/marcas', [MarcaWebController::class, 'store'])->name('marcas.store');
Route::get('/marcas/{marca}/edit', [MarcaWebController::class, 'edit'])->name('marcas.edit');
Route::put('/marcas/{marca}', [MarcaWebController::class, 'update'])->name('marcas.update');
Route::delete('/marcas/{marca}', [MarcaWebController::class, 'destroy'])->name('marcas.destroy');