<?php
    //Controlador para manejar los errores
    class Errorsito extends Controller{
        function __construct(){
            parent::__construct();
            //Crear un error generico en variable mensaje y mostrarlo en la vista del error (index)
            $this->view->mensaje = "Hubo un error en la solicitud o no existe la pagina";
            $this->view->render('errorsito/index');
            //echo'Error al cargar el recurso';
        }
    }
?>