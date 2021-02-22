<?php

include_once 'models/alumno.php';

class ConsultaModel extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function get(){
        $items = [];

        try{
            $query = $this->db->connect()->query("SELECT*FROM alumnos");
            //Poner cada elemento de la consulta en mi arreglo de items
            while($row = $query->fetch()){
                /*Crear un objeto en donde cada propiedad tendran los valores 
                de la base de datos*/
                $item = new Alumno();
                $item->matricula = $row['matricula'];
                $item->nombre    = $row['nombre'];
                $item->apellido  = $row['apellido'];
                //Ir agregando cada objeto al array que creamos de $items
                array_push($items, $item);
            }

            return $items;
        }catch(PDOException $e){
            return [];
        }
    }

    public function getById($id){
        $item = new Alumno();
        try{
            $query = $this->db->connect()->prepare('SELECT * FROM alumnos WHERE matricula = :matricula');

            $query->execute(['matricula' => $id]);
            
            //Asignar la informacion de cada alumno a las propiedades del objeto $item 
            while($row = $query->fetch()){
                $item->matricula = $row['matricula'];
                $item->nombre    = $row['nombre'];
                $item->apellido  = $row['apellido'];
            }
            //Retornara un objeto 
            return $item;
        }catch(PDOException $e){
            return null;
        }
    }

    //Funcion para actualizar el alumno (llamarla desde controllers/consulta)
    public function update($item){
        $query = $this->db->connect()->prepare('UPDATE alumnos SET nombre = :nombre, apellido = :apellido WHERE matricula = :matricula');

        try{
            $query->execute([
                'matricula' => $item['matricula'],
                'nombre' => $item['nombre'],
                'apellido' => $item['apellido']
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }

    }

     //Funcion para eliminar el alumno (llamarla desde controllers/consulta)
    public function delete($id){
        $query = $this->db->connect()->prepare('DELETE FROM alumnos WHERE matricula = :id');
        try{
            $query->execute([
                'id' => $id
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }
}

?>