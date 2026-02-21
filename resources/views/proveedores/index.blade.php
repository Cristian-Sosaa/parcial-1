@extends('layouts.app')

@section('title', 'Proveedores')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h1 class="h3 mb-0">Proveedores</h1>
  <a class="btn btn-primary" href="{{ route('proveedores.create') }}">Nuevo proveedor</a>
</div>

<div class="card">
  <div class="table-responsive">
    <table class="table table-striped mb-0 align-middle">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Teléfono</th>
          <th>Estado</th>
          <th class="text-end">Acciones</th>
        </tr>
      </thead>
      <tbody>
        @forelse($proveedores as $p)
          <tr>
            <td>{{ $p->id }}</td>
            <td>{{ $p->nombre }}</td>
            <td>{{ $p->telefono ?? '-' }}</td>
            <td>
              @if($p->estado)
                <span class="badge text-bg-success">Activo</span>
              @else
                <span class="badge text-bg-secondary">Inactivo</span>
              @endif
            </td>
            <td class="text-end">
              <a class="btn btn-sm btn-warning" href="{{ route('proveedores.edit', $p) }}">Editar</a>

              <form class="d-inline" method="POST" action="{{ route('proveedores.destroy', $p) }}"
                    onsubmit="return confirm('¿Eliminar este proveedor?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-danger" type="submit">Eliminar</button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td colspan="5" class="text-center text-muted">No hay proveedores</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection