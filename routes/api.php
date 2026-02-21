<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MarcaController;
use App\Http\Controllers\Api\CategoriaController;
use App\Http\Controllers\Api\ProveedorController;

Route::apiResource('marcas', MarcaController::class)->only(['index','store','update','destroy']);
Route::apiResource('categorias', CategoriaController::class)->only(['index','store','update','destroy']);
Route::apiResource('proveedores', ProveedorController::class)->only(['index','store','update','destroy']);