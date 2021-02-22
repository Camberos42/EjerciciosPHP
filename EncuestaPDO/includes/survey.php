<?php
    include_once 'includes/db.php';

    //Heredar los metodos de la clase DB 
    class Survey extends DB{
        private $totalVotes; //Contendra el conteo total de los votos que tiene cada opcion
        private $optionSelected;  //Opcion que el usuario selecciona

        //Los valores son privados para que no se puedan alterar, y para acceder a los valores se crean dos funciones:

        //Colocar un valor (la opcion del select)
        public function setOptionSelected($option){
            $this->optionSelected = $option;
        }

        //Obtener/devolver el valor que tenga asignado
        public function getOptionSelected(){
            return $this->optionSelected;
        }

        //Acceder a la base de datos y modificar el registro de los votos para añadirlo a uno
        public function vote(){
            //:opcion es una variable temporal o placeholder
            $query = $this->connect()->prepare('UPDATE deportes SET votos = votos + 1 WHERE opcion = :opcion');
            $query->execute(['opcion' => $this->optionSelected]);
        }

        //Realizar la consulta para mostrar los votos
        public function showResults(){
            return $this->connect()->query('SELECT * FROM deportes');
        }

        //Obtener los votos totales (suma de todos los registros de la columna votos)
        public function getTotalVotes(){
            $query =$this->connect()->query('SELECT SUM(votos) AS votos_totales FROM deportes');
            //Transformar de un objeto a un arreglo y asi acceder a votos totales
            $this->totalVotes = $query->fetch(PDO::FETCH_OBJ)->votos_totales;
            return $this->totalVotes;
        }

        //Cual es el % de acuerdo a la opcion
        public function getPercentageVotes($votes){
            return round(($votes / $this->totalVotes) * 100, 0);
        }

    }
?>