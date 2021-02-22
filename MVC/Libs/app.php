<?php
    require_once('controllers/errorsito.php');

class App{
    function __construct(){
        //echo "<p>Nueva app</p>";

        //Obtener la url (por la regla del .htaccess)
        $url = isset($_GET['url']) ? $_GET['url'] : null; //Validar si existe el controlador, de lo contrario retorna null
        //echo $url;

        //Descomponer la variable de la url (ej. si viene a/b me retorne la a y la b separadas)
        $url = rtrim($url,'/'); //Eliminar aquellos / que no necesite
        $url = explode('/', $url); //Dividir por cada /

        //var_dump($url);
        $archivoController = 'controllers/' . $url[0] . '.php'; 

        //Si no ingreso ningun controlador en la barra de direcciones cargara el controlador main de lo contrario seguira con el flujo 
        if(empty($url[0])){
            $archivoController = 'controllers/main.php';
            require_once $archivoController;
            $controller = new Main();
            $controller->loadModel('main'); //
            $controller->render(); //Para que aparezca la vista
            return false;
        }
        //Validar lo demas...
        $archivoController = 'controllers/' . $url[0] . '.php';
     
        //Si existe el archivo del controlador entonces cargar el controlador (con MVC/main)
        if(file_exists($archivoController)){
            require_once($archivoController);
            //Inicializar el controlador
            $controller = new $url[0];
            $controller->loadModel($url[0]); //cargamos el modelo

            // #  Se obtienen el número de param
            $nparam = sizeof($url);

            if($nparam > 1){
                // hay parámetros
                if($nparam > 2){
                    $param = [];
                    for($i = 2; $i < $nparam; $i++){
                        array_push($param, $url[$i]);
                    }
                    $controller->{$url[1]}($param);
                }else{
                    // solo se llama al método
                    $controller->{$url[1]}();
                }
            }else{
                // si se llama a un controlador
                $controller->render();  
            }
        }else{
            $controller = new Errorsito();    
        }

       


    }

    

}
?>