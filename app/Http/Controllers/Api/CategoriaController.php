<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoriaRequest;
use App\Http\Requests\UpdateCategoriaRequest;
use App\Models\Categoria;
use Illuminate\Http\JsonResponse;

class CategoriaController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Categoria::orderByDesc('id')->get());
    }

    public function store(StoreCategoriaRequest $request): JsonResponse
    {
        try {
            $categoria = Categoria::create([
                'nombre' => $request->nombre,
                'estado' => $request->input('estado', true),
            ]);

            return response()->json($categoria, 201);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Error al crear categoría'], 500);
        }
    }

    public function update(UpdateCategoriaRequest $request, Categoria $categoria): JsonResponse
    {
        try {
            $categoria->update($request->validated());
            return response()->json($categoria);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Error al actualizar categoría'], 500);
        }
    }

    public function destroy(Categoria $categoria): JsonResponse
    {
        try {
            $categoria->delete();
            return response()->json(['message' => 'Categoría eliminada']);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Error al eliminar categoría'], 500);
        }
    }
}