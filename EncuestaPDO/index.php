<?php
    include_once 'includes/survey.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="main.css">
    <title>Encuesta</title>

</head>

<body>
    <form action="#" method="POST">
        <?php
            $survey = new Survey();
            //Validar si quiero mostrar los resultados
            $showResults = false;
            //Validar que exista la variable lenguaje
            if(isset($_POST['lenguaje'])){
                $showResults = true;
                $survey->setOptionSelected($_POST['lenguaje']);
                $survey->vote();
            }

            //echo $survey->getTotalVotes();
        ?>
        <h2>¿Cual es tu deporte Favorito?</h2>
        <?php
            if($showResults){
                //Se almacena el total de todos los votos
                $deportes = $survey->showResults();
            

                //Muestra el total de los votos
                echo '<h2>' . $survey->getTotalVotes() . ' votos totales</h2>';

                //Obtener el porcentaje de cada deporte
                foreach($deportes as $deporte){
                    $porcentaje = $survey->getPercentageVotes($deporte['votos']);
                    include 'vistas/vista-resultados.php';
                }
            }else{
                //Mostrar las opciones para votar si aun no se vota
                include 'vistas/vista-votacion.php';
            }

        ?>

    </form>

</body>
</html>

