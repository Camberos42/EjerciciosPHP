<?php

include_once 'db.php';


class Pelicula extends DB{

    //Obtener las peliculas de la BD
    function obtenerPeliculas(){
        $query = $this->connect()->query('SELECT * FROM pelicula');
        
        return $query;
    }

    //funcion para obtener pelicula individual
    function obtenerPelicula($id){
        //Se hace de esta forma para evitar inyeccion sql 
        $query = $this->connect()->prepare('SELECT * FROM pelicula WHERE id = :id');
        $query->execute(['id' => $id]);

         return $query;
    }

    //Ingresar una nueva pelicula (recibe un diccionario como parametro)
    function nuevaPelicula($pelicula){
        $query = $this->connect()->prepare('INSERT INTO pelicula (nombre, imagen) VALUES (:nombre, :imagen)');
        $query->execute(['nombre' => $pelicula['nombre'], 'imagen' => $pelicula['imagen']]);
        return $query;
    }

}

?>