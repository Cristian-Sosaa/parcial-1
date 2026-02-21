@extends('layouts.app')

@section('title', 'Editar Categoría')

@section('content')
<h1 class="h3 mb-3">Editar categoría</h1>

<div class="card">
  <div class="card-body">
    <form method="POST" action="{{ route('categorias.update', $categoria) }}">
      @csrf
      @method('PUT')

      <div class="mb-3">
        <label class="form-label">Nombre</label>
        <input class="form-control" name="nombre" value="{{ old('nombre', $categoria->nombre) }}" required>
      </div>

      <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" name="estado" id="estado"
               {{ old('estado', $categoria->estado) ? 'checked' : '' }}>
        <label class="form-check-label" for="estado">Activo</label>
      </div>

      <button class="btn btn-primary" type="submit">Actualizar</button>
      <a class="btn btn-secondary" href="{{ route('categorias.index') }}">Cancelar</a>
    </form>
  </div>
</div>
@endsection