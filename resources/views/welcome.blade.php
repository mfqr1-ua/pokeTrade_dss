<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>PokeMarket TCG</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      height: 100vh;
      background: url('/imagenes/fondo.png') no-repeat center center fixed;
      background-size: cover;
      font-family: 'Arial', sans-serif;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      position: relative;
    }

    .mensaje {
      position: absolute;
      top: 5%; /* ← bajado del 15% al 30% */
      left: 50%;
      transform: translateX(-50%);
      background: #C0C0C0;
      color: white;
      padding: 15px 30px;
      border-radius: 10px;
      font-size: 1.8rem;
      font-weight: bold;
      box-shadow: 2px 2px 10px rgba(0,0,0,0.3);
    }


    .mensaje-info {
      position: absolute;
      left: 50%;
      bottom: 15%;
      transform: translateX(-50%);
      background: #C0C0C0;
      color: white;
      padding: 15px 30px;
      border-radius: 10px;
      font-size: 1.2rem;
      font-weight: bold;
      box-shadow: 2px 2px 10px rgba(0,0,0,0.3);
    }

    .pokeball {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      background: linear-gradient(to bottom, red 50%, white 50%);
      border: 5px solid black;
      position: relative;
      box-shadow: 0 0 20px rgba(0,0,0,0.2);
      cursor: pointer;
      transition: transform 0.3s;
      bottom: 15%;
    }

    .pokeball::before {
      content: '';
      position: absolute;
      top: 50%;
      left: 0;
      width: 100%;
      height: 5px;
      background: black;
      transform: translateY(-50%);
      z-index: 1;
    }

    .button-center {
      width: 40px;
      height: 40px;
      background: white;
      border: 5px solid black;
      border-radius: 50%;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      z-index: 2;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .pokeball:hover .button-center {
      transform: translate(-50%, -50%) scale(1.1);
      box-shadow: 0 0 10px #000;
    }
  </style>
</head>
<body>

  <div class="mensaje">Pulsa el botón para comenzar la aventura</div>

  <div class="pokeball" id="pokeball">
    <div class="button-center"></div>
  </div>

  <div class="mensaje-info">Nuestro proyecto PokeMarket TCG es una página web encargada de la compraventa de cartas de Pokémon. Nuestro objetivo es ofrecer un acceso seguro a las cartas de este mundillo, permitiendo la compra y autentificando cada usuario de forma intuitiva. De este modo, solo los usuarios autentificados podrán acceder a la compra y venta de cartas, y contaremos con administradores que podrán gestionar todos los usuarios y las cartas subidas, junto con las categorías.</div>

  <script>
    document.getElementById('pokeball').addEventListener('click', () => {
      window.location.href = "inicio";
    });
  </script>

</body>
</html>