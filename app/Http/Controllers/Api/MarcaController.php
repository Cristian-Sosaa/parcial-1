<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMarcaRequest;
use App\Http\Requests\UpdateMarcaRequest;
use App\Models\Marca;
use Illuminate\Http\JsonResponse;

class MarcaController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Marca::orderByDesc('id')->get());
    }

    public function store(StoreMarcaRequest $request): JsonResponse
    {
        try {
            $marca = Marca::create([
                'nombre' => $request->nombre,
                'estado' => $request->input('estado', true),
            ]);

            return response()->json($marca, 201);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Error al crear marca'], 500);
        }
    }

    public function update(UpdateMarcaRequest $request, Marca $marca): JsonResponse
    {
        try {
            $marca->update($request->validated());
            return response()->json($marca);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Error al actualizar marca'], 500);
        }
    }

    public function destroy(Marca $marca): JsonResponse
    {
        try {
            $marca->delete();
            return response()->json(['message' => 'Marca eliminada']);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Error al eliminar marca'], 500);
        }
    }
}