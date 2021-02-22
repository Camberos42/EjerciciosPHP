<?php

class Consulta extends Controller{

    //public $model;

    function __construct(){
        parent::__construct();
        $this->view->alumnos = [];
        //echo "<p>Nuevo controlador Main</p>";
    }

    function render(){  
        $alumnos = $this->model->get();
        $this->view->alumnos = $alumnos;
        $this->view->render('consulta/index');
    }

    //Ver detalle del alumno
    function verAlumno($param = null){
        //var_dump($param);
        $idAlumno = $param[0]; //Porque si hay mas parametros solo me interesa el primero que seria la matricula
        $alumno = $this->model->getById($idAlumno); //LLamar al metodo y gaurdar el valor a la variable

        //Para que el usuario no pueda modificar su matricula desde el inspector
        session_start();
        $_SESSION["id_verAlumno"] = $alumno->matricula;

        $this->view->alumno = $alumno; //Asignarlo al objeto
        $this->view->mensaje = ""; //Para que no marque error al cargar el archivo de detalle
        $this->view->render('consulta/detalle'); //Renderizar la vista
    }

    //Se encargara de la actualizacion en la base de datos
    function actualizarAlumno(){
        session_start();
        $matricula = $_SESSION["id_verAlumno"];
        $nombre    = $_POST['nombre'];
        $apellido  = $_POST['apellido'];

        //Destruir la sesion cuando ya no la necesitemos
        unset($_SESSION['id_verAlumno']);

        //Validar si el return del metodo update es true
        if($this->model->update(['matricula' => $matricula, 'nombre' => $nombre, 'apellido' => $apellido])){
            //Actualizar alumno exito (se crea un objeto alumno)
            $alumno = new Alumno();
            $alumno->matricula = $matricula;
            $alumno->nombre = $nombre;
            $alumno->apellido = $apellido;

            //
            $this->view->alumno = $alumno;
            $this->view->mensaje = "Alumno actualizado correctamente";
        }else{
            //Mensaje de error
            $this->view->mensaje = "No se pudo actualizar al alumno";
        }
        //Renderizar la pagina de detalle
        $this->view->render('consulta/detalle');
    }

    function eliminarAlumno($param = null){
        $matricula = $param[0];

        if($this->model->delete($matricula)){
            // $this->view->mensaje = "Alumno eliminado correctamente";
            $mensaje ="Alumno eliminado correctamente";
        }else{
            // $this->view->mensaje = "No se pudo eliminar al alumno";
            $mensaje = "No se pudo eliminar al alumno";
        }

        //$this->render();

        echo $mensaje;
        //echo "Se eliminó ". $matricula;
    }
}

?>