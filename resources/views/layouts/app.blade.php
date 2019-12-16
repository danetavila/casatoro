<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Casatoro') }}</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <div id="menu">
        <header class="major">
            <h2>Menu</h2>
        </header>
        <nav>
            <ul id="accordion1" class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a class="nav-link"  href="{{route('products.create')}}">Producto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  href="{{route('inventory.create')}}">Inventario</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#item-2" data-parent="#accordion1">Facturación<i class="opener"></i></a>
                    <div id="item-2" class="collapse">
                        <ul class="nav flex-column ml-3">
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('sales.create')}}">Facturar</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('sales.index')}}">Histórico de Venta</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#item-3" data-parent="#accordion1">Reportes <i class="opener"></i></a>
                    <div id="item-3" class="collapse">
                    <ul class="nav flex-column ml-3">
                        <li class="nav-item">
                        <a class="nav-link" href="{{route('report.index')}}">Inventario</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="{{route('inventory.index')}}">Disponibilidad Inventario</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="{{route('report.create')}}">Productos más Vendidos</a>
                        </li>
                    </ul>
                    </div>
                </li>
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
@stack('scripts')
</body>
</html>
