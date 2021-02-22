<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Paginación</title>
    <link rel="stylesheet" href="main.css">
    <style>
        body {
            font-family: Arial;
        }

        #container {
            width: 500px;
            margin: 0 auto;
        }

        .pelicula {
            display: inline-block;
            width: 120px;
            padding: 10px;
            text-align: center;
            vertical-align: top;
        }

        #paginas ul {
            margin: 10px 0;
            padding: 0;
        }

        #paginas li {
            display: inline-block;
            margin: 0;
            padding: 10px;
        }

        #paginas li a {
            background: rgb(228, 228, 228);
            border-radius: 3px;
            color: rgb(50, 50, 50);
            padding: 10px 15px;
            text-decoration: none;
        }

        .actual {
            background: rgb(20, 69, 124) !important;
            color: rgb(255, 255, 255) !important;
        }
    
    </style>
</head>
<body>
<?php
        include_once 'peliculas.php';  
        $peliculas = new Peliculas(3);
?>
    <div id="container">
        <div id="paginas">
            <?php $peliculas->mostrarPaginas();?>
        </div>
           
        <div id="peliculas">
            <?php $peliculas->mostrarPeliculas();?>
        </div>

    </div>
    
</body>
</html>