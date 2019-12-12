<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <div id="menu">
        <header class="major">
            <h2>Menu</h2>
        </header>
        <nav>
            <ul>
                <li class="active"><a href="{{route('products.create')}}">Inicio</a></li>
                <li><a href="{{route('products.create')}}">Producto</a></li>
                <li><a href="{{route('inventory.create')}}">Inventario</a></li>
                <li><a href="{{route('sales.create')}}">Facturar</a></li>
                <li><a href="#">Reportes</a></li>
            </ul>
        </nav>
    </div>
    <div id="wrapper">
        <div class="container">
            <section>
                @yield('content')
            </section>
        </div>
    </div>
</div>

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
