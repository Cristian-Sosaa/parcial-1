<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorWebController extends Controller
{
    public function index()
    {
        $proveedores = Proveedor::orderByDesc('id')->get();
        return view('proveedores.index', compact('proveedores'));
    }

    public function create()
    {
        return view('proveedores.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => ['required','string','max:255'],
            'telefono' => ['nullable','string','max:50'],
        ]);

        // checkbox → boolean real
        $data['estado'] = $request->has('estado');

        Proveedor::create($data);

        return redirect()->route('proveedores.index')->with('ok', 'Proveedor creado');
    }

    public function edit(Proveedor $proveedore)
    {
        return view('proveedores.edit', ['proveedor' => $proveedore]);
    }

    public function update(Request $request, Proveedor $proveedore)
    {
        $data = $request->validate([
            'nombre' => ['required','string','max:255'],
            'telefono' => ['nullable','string','max:50'],
        ]);

        // checkbox → boolean real
        $data['estado'] = $request->has('estado');

        $proveedore->update($data);

        return redirect()->route('proveedores.index')->with('ok', 'Proveedor actualizado');
    }

    public function destroy(Proveedor $proveedore)
    {
        $proveedore->delete();

        return redirect()->route('proveedores.index')->with('ok', 'Proveedor eliminado');
    }
}