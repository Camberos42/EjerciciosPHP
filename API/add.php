<?php
     include_once 'apipeliculas.php';

     $api = new ApiPeliculas(); //Para poder llamar a las funciones subirImagen, getImagen y add. 

     //Validar el nombre de la pelicula y el archivo (de la imagen)
     if(isset($_POST['nombre']) && isset($_FILES['imagen'])){

        //Validar que el archivo si se suba (la imagen) al server
        if($api->subirImagen($_FILES['imagen'])){ //Funcion subirImagen
            // insertar datos
            $item = array(
                'nombre' => $_POST['nombre'],
                'imagen' => $api->getImagen() //Funcion getImagen
            );
            $api->add($item); //Funcion de add
        }else{
            //Mostrar informacion completa acerca del error
            $api->error('Error con el archivo ' . $api->getError()); 
        }
     }else{
         $api->error("Error al llamar la API");
     }
?>