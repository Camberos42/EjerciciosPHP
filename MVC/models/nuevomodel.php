<?php

class NuevoModel extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function insert($datos){
        // insertar datos en la BD //Llamadas a mis tablas y a la BD
        try{
            $query = $this->db->connect()->prepare('INSERT INTO ALUMNOS (MATRICULA, NOMBRE, APELLIDO) VALUES (:matricula, :nombre, :apellido)');
            $query->execute(['matricula' => $datos['matricula'], 'nombre' => $datos['nombre'], 'apellido' => $datos['apellido']]);
            //echo "Insertar Datos";
            return true;
        }catch(PDOException $e){
            echo "Ya existe esa matrícula";
            return false;
        }
        
    }
}

?>