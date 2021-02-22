<?php

class View{

    function __construct(){
        //echo "<p>Vista base</p>";
    }

    //Renderizar o mostrar la vista que especifique de acuero al parametro nombre
    function render($nombre){
        require 'views/' . $nombre . '.php';
    }
}

?>