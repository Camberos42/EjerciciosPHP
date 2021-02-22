<?php

class Nuevo extends Controller{

    function __construct(){
        parent::__construct();
        $this->view->mensaje = ""; //Para que no marque error al querer mostrar el mensaje
        //echo "<p>Nuevo controlador Main</p>";
    }

    function render(){
        $this->view->render('nuevo/index');
    }

    function registrarAlumno(){
        $matricula = $_POST['matricula'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $mensaje = "";
        /*Pasar la informacion por medio de un arreglo (validar si la funcion retorna true mostrar que se creo el usuario 
        de lo contrario ya existe la matricula)*/
        if($this->model->insert(['matricula' => $matricula, 'nombre' => $nombre, 'apellido' => $apellido])){
            $mensaje =  "Alumno creado";
        }else{
            $mensaje = "La matricula ya existe";
        }

        //Agregarle un nuevo mensaje a mi vista
        $this->view->mensaje = $mensaje;
        //Cargar el render llamando el metodo
        $this->render();
       
    }
}

?>