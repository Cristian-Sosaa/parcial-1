<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    public function index()
    {
        $marcas = Marca::all();
        return response()->json($marcas);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $marca = Marca::create([
            'nombre' => $request->nombre,
            'estado' => $request->has('estado') ? $request->estado : true,
        ]);

        return response()->json($marca, 201);
    }

    public function show($id)
    {
        $marca = Marca::findOrFail($id);
        return response()->json($marca);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $marca = Marca::findOrFail($id);
        $marca->update([
            'nombre' => $request->nombre,
            'estado' => $request->has('estado') ? $request->estado : $marca->estado,
        ]);

        return response()->json($marca);
    }

    public function destroy($id)
    {
        $marca = Marca::findOrFail($id);
        $marca->delete(); // Soft Delete
        return response()->json(['message' => 'Marca eliminada correctamente']);
    }
}