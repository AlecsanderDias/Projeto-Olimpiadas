<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Olimpíadas do Instituto - {{ $title }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
</head>
<body>
    @if(Route::current()->uri() != 'login')
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home.index') }}">Home</a>
            @auth
            <a href="{{ route('logout') }}">Sair</a>
            @endauth

            @guest
            <a href="{{ route('login') }}">Entrar</a>
            @endguest
        </div>
    </nav>
    @endif
    <h1>{{ $title }}</h1>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{ $slot }}
</body>
</html>