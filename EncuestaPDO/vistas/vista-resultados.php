<div class="opcion">
    <?php
        //Altura maxima si hubiera un solo voto seria 500px
        $widthBar = $porcentaje * 5;
        //El estilo inicial es barra (cuando se vota por una opcion cambia a seleccionado)
        $estilo = "barra";

        //Si la opcion seleccionada es igual a la opcion actual que esta dada por el foreach
        if($survey->getOptionSelected() == $deporte['opcion']){
            //Se aplica el estilo (de la opcion que selecciono el usuar io)
            $estilo = "seleccionado";
        }

        //Construir los resultados (beisbol, soccer, basquetbol...)
        echo $deporte['opcion'];
    ?>
    <!-- Darle estilo, asignarle clase seleccionado o barra -->
    <div class="<?php echo $estilo; ?>" style="width: <?php echo $widthBar . 'px;' ?>"><?php echo $porcentaje . '%';  ?>
    </div>

</div>