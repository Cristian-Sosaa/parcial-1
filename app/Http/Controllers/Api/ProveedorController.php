<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProveedorRequest;
use App\Http\Requests\UpdateProveedorRequest;
use App\Models\Proveedor;
use Illuminate\Http\JsonResponse;

class ProveedorController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Proveedor::orderByDesc('id')->get());
    }

    public function store(StoreProveedorRequest $request): JsonResponse
    {
        try {
            $proveedor = Proveedor::create([
                'nombre' => $request->nombre,
                'telefono' => $request->input('telefono'),
                'estado' => $request->input('estado', true),
            ]);

            return response()->json($proveedor, 201);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Error al crear proveedor'], 500);
        }
    }

    public function update(UpdateProveedorRequest $request, Proveedor $proveedor): JsonResponse
    {
        try {
            $proveedor->update($request->validated());
            return response()->json($proveedor);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Error al actualizar proveedor'], 500);
        }
    }

    public function destroy(Proveedor $proveedor): JsonResponse
    {
        try {
            $proveedor->delete();
            return response()->json(['message' => 'Proveedor eliminado']);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Error al eliminar proveedor'], 500);
        }
    }
}