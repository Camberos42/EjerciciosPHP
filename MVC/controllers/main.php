<?php
    class Main extends Controller{
        function __construct(){
            //Llamar al constructor de controller (clase padre)
            parent::__construct(); 
            //Cargar la vista del index
            //echo "<p>Nuevo controlador Main</p>";
        }

        function render(){
            $this->view->render('main/index');
        }

        //Crear metodo saludo (llamarlo con /main/saludo en la url)
        function saludo(){
            echo "<p>Ejecutaste el método Saludo</p>";
        }
    }
?>