<?php
    //var_dump($_FILES["file"]);

    //Construir la direccion donde se guardara el archivo
    $directorio = "uploads/";
    $archivo = $directorio . basename($_FILES["file"]["name"]);

    //Saber el tipo de archivo
    $tipoArchivo = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));

    //Validar si el archivo es imagen //Retorna false si no es tipo imagen
    $checarSiImagen = getimagesize($_FILES["file"]["tmp_name"]);

    //var_dump($size);

    if($checarSiImagen != false){

        //validando tamaño del archivo (esta en Kb)
        $size = $_FILES["file"]["size"];

        //Validar que no supere una cantidad de kb (que no sea tan grande)
        if($size > 500000){
            echo "El archivo tiene que ser menor a 500kb";
        }else{
            //validar tipo de imagen (que solo acepte formato jpg o jpeg)
            if($tipoArchivo == "jpg" || $tipoArchivo == "jpeg"){
                 // se validó el archivo correctamente

                 //Validar que si se este haciendo la transferencia
                 if(move_uploaded_file($_FILES["file"]["tmp_name"], $archivo)){ //Parametros son la ruta temporal y el archivo
                    echo "El archivo se subió correctamente";
                }else{
                    echo "Hubo un error en la subida del archivo";
                }
            }else{
                echo "Solo se admiten archivos jpg/jpeg";
            }
        }

    }else{
        echo "El documento no es una imagen";
    }

?>