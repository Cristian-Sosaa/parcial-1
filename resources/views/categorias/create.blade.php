@extends('layouts.app')

@section('title', 'Nueva Categoría')

@section('content')
<h1 class="h3 mb-3">Nueva categoría</h1>

<div class="card">
  <div class="card-body">
    <form method="POST" action="{{ route('categorias.store') }}">
      @csrf

      <div class="mb-3">
        <label class="form-label">Nombre</label>
        <input class="form-control" name="nombre" value="{{ old('nombre') }}" required>
      </div>

      <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" name="estado" id="estado" checked>
        <label class="form-check-label" for="estado">Activo</label>
      </div>

      <button class="btn btn-primary" type="submit">Guardar</button>
      <a class="btn btn-secondary" href="{{ route('categorias.index') }}">Cancelar</a>
    </form>
  </div>
</div>
@endsection