<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Inventario')</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/">Inventario</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>

            </ul>
        </div>
    </div>
</nav>

<!-- CONTENIDO -->
<main class="container py-4">

    <!-- Mensaje éxito -->
    @if(session('ok'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('ok') }}
            <button class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Errores de validación -->
    @if($errors->any())
        <div class="alert alert-danger">
            <strong>⚠️ Revisa los campos:</strong>
            <ul class="mb-0">
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('content')

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>