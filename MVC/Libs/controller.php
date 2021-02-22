  
<?php

class Controller{

    function __construct(){
        //echo "<p>Controlador base</p>";
        $this->view = new View(); //Crear una nueva vista por cada controlador
    }
    //Cargar el modelo (en los controladores que requiera traer datos)
    function loadModel($model){
        $url = 'models/'.$model.'model.php';

        //Valida que el modelo existe
        if(file_exists($url)){
            require $url;

            $modelName = $model.'Model';
            //echo $modelName;
            $this->model = new $modelName();
        }
    }
}

?>