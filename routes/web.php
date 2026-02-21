<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\MarcaWebController;
use App\Http\Controllers\Web\CategoriaWebController;
use App\Http\Controllers\Web\ProveedorWebController;

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

// Categorías
Route::get('/categorias', [CategoriaWebController::class, 'index'])->name('categorias.index');
Route::get('/categorias/create', [CategoriaWebController::class, 'create'])->name('categorias.create');
Route::post('/categorias', [CategoriaWebController::class, 'store'])->name('categorias.store');
Route::get('/categorias/{categoria}/edit', [CategoriaWebController::class, 'edit'])->name('categorias.edit');
Route::put('/categorias/{categoria}', [CategoriaWebController::class, 'update'])->name('categorias.update');
Route::delete('/categorias/{categoria}', [CategoriaWebController::class, 'destroy'])->name('categorias.destroy');

// Proveedores
Route::get('/proveedores', [ProveedorWebController::class, 'index'])->name('proveedores.index');
Route::get('/proveedores/create', [ProveedorWebController::class, 'create'])->name('proveedores.create');
Route::post('/proveedores', [ProveedorWebController::class, 'store'])->name('proveedores.store');
Route::get('/proveedores/{proveedore}/edit', [ProveedorWebController::class, 'edit'])->name('proveedores.edit');
Route::put('/proveedores/{proveedore}', [ProveedorWebController::class, 'update'])->name('proveedores.update');
Route::delete('/proveedores/{proveedore}', [ProveedorWebController::class, 'destroy'])->name('proveedores.destroy');