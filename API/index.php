<?php
    include_once 'apipeliculas.php';

    $api = new ApiPeliculas();

    //Validar que existe el get[id]
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        //Validar que es numerico
        if(is_numeric($id)){
            $api->getByID($id);
        }else{
            $api->error('Los parametros son incorrectos');
        }
        
    }else{
        $api->getAll();
    }
 
    
?>