<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaWebController extends Controller
{
    public function index()
    {
        $marcas = Marca::orderByDesc('id')->get();
        return view('marcas.index', compact('marcas'));
    }

    public function create()
    {
        return view('marcas.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
        ]);

        // checkbox -> boolean real
        $data['estado'] = $request->has('estado');

        Marca::create($data);

        return redirect()->route('marcas.index')->with('ok', 'Marca creada');
    }

    public function edit(Marca $marca)
    {
        return view('marcas.edit', compact('marca'));
    }

    public function update(Request $request, Marca $marca)
    {
        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
        ]);

        // checkbox -> boolean real
        $data['estado'] = $request->has('estado');

        $marca->update($data);

        return redirect()->route('marcas.index')->with('ok', 'Marca actualizada');
    }

    public function destroy(Marca $marca)
    {
        $marca->delete();
        return redirect()->route('marcas.index')->with('ok', 'Marca eliminada');
    }
}