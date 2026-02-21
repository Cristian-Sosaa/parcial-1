@extends('layouts.app')

@section('title', 'Marcas')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h1 class="h3 mb-0">Marcas</h1>
  <a class="btn btn-primary" href="{{ route('marcas.create') }}">Nueva marca</a>
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
        @forelse($marcas as $m)
          <tr>
            <td>{{ $m->id }}</td>
            <td>{{ $m->nombre }}</td>
            <td>
              @if($m->estado)
                <span class="badge text-bg-success">Activo</span>
              @else
                <span class="badge text-bg-secondary">Inactivo</span>
              @endif
            </td>
            <td class="text-end">
              <a class="btn btn-sm btn-warning" href="{{ route('marcas.edit', $m) }}">Editar</a>

              <form class="d-inline" method="POST" action="{{ route('marcas.destroy', $m) }}"
                    onsubmit="return confirm('¿Eliminar esta marca?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-danger" type="submit">Eliminar</button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="4" class="text-center text-muted">No hay marcas</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection