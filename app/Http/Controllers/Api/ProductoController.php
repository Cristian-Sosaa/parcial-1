<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::with(['marca', 'categoria', 'proveedor'])->get();
        return response()->json($productos);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'marca_id' => 'required|exists:marcas,id',
            'categoria_id' => 'required|exists:categorias,id',
            'proveedor_id' => 'required|exists:proveedores,id',
        ]);

        $producto = Producto::create([
            'nombre' => $request->nombre,
            'precio' => $request->precio,
            'estado' => $request->has('estado') ? $request->estado : true,
            'marca_id' => $request->marca_id,
            'categoria_id' => $request->categoria_id,
            'proveedor_id' => $request->proveedor_id,
        ]);

        return response()->json($producto->load(['marca', 'categoria', 'proveedor']), 201);
    }

    public function show($id)
    {
        $producto = Producto::with(['marca', 'categoria', 'proveedor'])->findOrFail($id);
        return response()->json($producto);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'marca_id' => 'required|exists:marcas,id',
            'categoria_id' => 'required|exists:categorias,id',
            'proveedor_id' => 'required|exists:proveedores,id',
        ]);

        $producto = Producto::findOrFail($id);
        $producto->update([
            'nombre' => $request->nombre,
            'precio' => $request->precio,
            'estado' => $request->has('estado') ? $request->estado : $producto->estado,
            'marca_id' => $request->marca_id,
            'categoria_id' => $request->categoria_id,
            'proveedor_id' => $request->proveedor_id,
        ]);

        return response()->json($producto->load(['marca', 'categoria', 'proveedor']));
    }

    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete(); // Soft Delete
        return response()->json(['message' => 'Producto eliminado correctamente']);
    }
}