<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaWebController extends Controller
{
    public function index()
    {
        $categorias = Categoria::orderByDesc('id')->get();
        return view('categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('categorias.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => ['required','string','max:255'],
            'estado' => ['nullable','boolean'],
        ]);

        $data['estado'] = $request->has('estado');

        Categoria::create($data);

        return redirect()->route('categorias.index')->with('ok', 'Categoría creada');
    }

    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', compact('categoria'));
    }

    public function update(Request $request, Categoria $categoria)
    {
        $data = $request->validate([
            'nombre' => ['required','string','max:255'],
            'estado' => ['nullable','boolean'],
        ]);

        $data['estado'] = $request->has('estado');

        $categoria->update($data);

        return redirect()->route('categorias.index')->with('ok', 'Categoría actualizada');
    }

    public function destroy(Categoria $categoria)
    {
        $categoria->delete();

        return redirect()->route('categorias.index')->with('ok', 'Categoría eliminada');
    }
}