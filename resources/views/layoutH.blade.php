<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
            background-color: #212529;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .cover-container {
            max-width: 800px;
            width: 100%;
        }

        .navbar {
            width: 100%;
            display: flex;
            justify-content: center;
            position: absolute;
            top: 0;
        }

        .navbar-nav {
            display: flex;
            flex-direction: row;
            gap: 20px;
        }

        main {
            width: 100%;
        }

        .lead {
            text-align: justify;
            max-width: 700px;
            margin: auto;
        }
    </style>
</head>
<body class="text-white bg-dark">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container d-flex justify-content-center">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/album">Álbum</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="cover-container">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
