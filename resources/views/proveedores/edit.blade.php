@extends('layouts.app')

@section('title', 'Editar Proveedor')

@section('content')
<h1 class="h3 mb-3">Editar proveedor</h1>

<div class="card">
  <div class="card-body">
    <form method="POST" action="{{ route('proveedores.update', $proveedor) }}">
      @csrf
      @method('PUT')

      <div class="mb-3">
        <label class="form-label">Nombre</label>
        <input class="form-control" name="nombre" value="{{ old('nombre', $proveedor->nombre) }}" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Teléfono</label>
        <input class="form-control" name="telefono" value="{{ old('telefono', $proveedor->telefono) }}">
      </div>

      <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" name="estado" id="estado"
               {{ old('estado', $proveedor->estado) ? 'checked' : '' }}>
        <label class="form-check-label" for="estado">Activo</label>
      </div>

      <button class="btn btn-primary" type="submit">Actualizar</button>
      <a class="btn btn-secondary" href="{{ route('proveedores.index') }}">Cancelar</a>
    </form>
  </div>
</div>
@endsection