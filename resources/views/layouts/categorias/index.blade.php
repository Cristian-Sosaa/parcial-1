@extends('layouts.app')

@section('title', 'Categorías')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h1 class="h3 mb-0">Categorías</h1>
  <a class="btn btn-primary" href="{{ route('categorias.create') }}">Nueva categoría</a>
</div>

<div class="card">
  <div class="table-responsive">
    <table class="table table-striped mb-0 align-middle">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Estado</th>
          <th class="text-end">Acciones</th>
        </tr>
      </thead>
      <tbody>
        @forelse($categorias as $c)
          <tr>
            <td>{{ $c->id }}</td>
            <td>{{ $c->nombre }}</td>
            <td>
              @if($c->estado)
                <span class="badge text-bg-success">Activo</span>
              @else
                <span class="badge text-bg-secondary">Inactivo</span>
              @endif
            </td>
            <td class="text-end">
              <a class="btn btn-sm btn-warning" href="{{ route('categorias.edit', $c) }}">Editar</a>

              <form class="d-inline" method="POST" action="{{ route('categorias.destroy', $c) }}"
                    onsubmit="return confirm('¿Eliminar esta categoría?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-danger" type="submit">Eliminar</button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td colspan="4" class="text-center text-muted">No hay categorías</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection