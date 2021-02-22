<?php

include_once 'pelicula.php';

//EN ESTA CLASE ESTARAN LAS FUNCIONES DE LA api
class ApiPeliculas{
    private $imagen;
    private $error;

    //Funcion que permita llamar al objeto de pelicula
    function getAll(){
        $pelicula = new Pelicula();
        //Se tendra un arreglo de peliculas
        $peliculas = array();
        //Se le agrega un elemento item de tipo Array
        $peliculas["items"] = array();

        //Valor que retorna el objeto de la respuesta de obtenerpeliculas
        $res = $pelicula->obtenerPeliculas();
        
        //Validar que no este vacio 
        if($res->rowCount()){
            //Funcion fetch(PDO::FETCH_ASSOC) Modo de hacer el recorrido
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                
                //Crear el elemento item 
                $item=array(
                    "id" => $row['id'],
                    "nombre" => $row['nombre'],
                    "imagen" => $row['imagen'],
                );
                //Añadir el elemento al array $peliculas["items"] declarado arriba 
                array_push($peliculas["items"], $item);
            }
            //Parseo a json el arreglo de objetos
            //echo json_encode($peliculas);
            $this->printJSON($peliculas);
        }else{
            $this->error("No hay elementos registrados");
        }
    }

    //Funcion de mostrar la pelicula individual
    function getByID($id){
        $pelicula = new Pelicula();
        $peliculas = array();
        $peliculas["items"] = array();

        //Se modifica esta parte para obtener una pelicula recibiendo como parametro el id
        $res = $pelicula->obtenerPelicula($id);
        
        //Validar que no este vacio 
        if($res->rowCount() == 1){
            $row = $res->fetch();

            $item=array(
                "id" => $row['id'],
                "nombre" => $row['nombre'],
                "imagen" => $row['imagen'],
            );

            array_push($peliculas["items"], $item);
            $this->printJSON($peliculas);

        }else{
            echo $this->error("No hay elementos registrados");
        }
    }

    //Añadir un nuevo elemento
    function add($item){
        $pelicula = new Pelicula();

        $res = $pelicula->nuevaPelicula($item);
        $this->exito('Nueva pelicula registrada');
    }

    //Imprimir la estructura del json
    function printJSON($array){
        echo '<code>'.json_encode($array).'</code>';
    }


    //Funcion para mapear los errores que se van generando en todo el programa 
    function error($mensaje){
        echo '<code>'. json_encode(array('mensaje' => $mensaje)) .'</code>';
    }

    //Funcion para mostrar un mensaje de exito (por ejemplo cuando se cree una pelicula)
    function exito($mensaje){
        echo json_encode(array('mensaje' => $mensaje)); 
    }

    function subirImagen($file){
        $directorio = "images/";

        $this->imagen = basename($file["name"]); //OBTENER EL NOMBRE DE LA IMAGEN 
        $archivo = $directorio . basename($file["name"]);

        $tipoArchivo = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));
    
        // valida que es imagen
        $checarSiImagen = getimagesize($file["tmp_name"]);

        if($checarSiImagen != false){
            //validando tamaño del archivo
            $size = $file["size"];

            if($size > 500000){
                $this->error = "El archivo tiene que ser menor a 500kb";
                return false;
            }else{

                //validar tipo de imagen
                if($tipoArchivo == "jpg" || $tipoArchivo == "jpeg"){
                    // se validó el archivo correctamente
                    if(move_uploaded_file($file["tmp_name"], $archivo)){
                        //echo "El archivo se subió correctamente";
                        return true;
                    }else{
                        $this->error = "Hubo un error en la subida del archivo";
                        return false;
                    }
                }else{
                    $this->error = "Solo se admiten archivos jpg/jpeg";
                    return false;
                }
            }
        }else{
            $this->error = "El documento no es una imagen";
            return false;
        }
    }

    //Para obtener el valor de la imagen
    function getImagen(){
        return $this->imagen;
    }

    //Para obtener el valor de error
    function getError(){
        return $this->error;
    }
}

?>