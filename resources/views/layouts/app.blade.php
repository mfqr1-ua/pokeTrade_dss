@yield('head')

<!DOCTYPE html>
<html lang="es"> 
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <title>PokeMarket TCG</title>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

        <style>
            body {
                font-family: Arial, sans-serif;
                background-image: url('{{ asset('imagenes/fondo.png') }}');
                background-size: cover;      
                background-repeat: no-repeat;
                background-position: center; 
                padding: 20px;
            }

            .container {
                height: 100vh;
                width: auto;
                margin: auto;
                padding: 30px;
            }

            h1 {
                text-align: center;
            }
        </style>
    </head>

    <body>
        @include('componentes.header')
        <div class="container">
            @yield('content')
        </div>
        @yield('scripts')
    </body>
</html>