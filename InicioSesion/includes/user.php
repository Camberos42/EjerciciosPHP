<?php

include_once 'db.php';

class User extends DB{

    private $nombre;
    private $username;

    //Validar si existe el usuario
    public function userExists($user, $pass){
        //Transformar el password 
        //$md5pass = md5($pass);
        $md5pass = $pass;

        //Consulta a la BD
        $query = $this->connect()->prepare('SELECT * FROM usuarios WHERE username = :user AND password = :pass');
        $query->execute(['user' => $user, 'pass' => $md5pass]);

        //Validar si hay filas  (si si hay, si esta el usuario)
        if($query->rowCount()){
            return true;
        }else{
            return false;
        }
    }

    //Asignar de acuerdo a un nombre de usuario , se llenara la variable de usuario
    public function setUser($user){
        $query = $this->connect()->prepare('SELECT * FROM usuarios WHERE username = :user');
        //Asignarle el valor (es como el ?)
        $query->execute(['user' => $user]);

        foreach ($query as $currentUser) {
            $this->nombre = $currentUser['nombre'];
            $this->username = $currentUser['username'];
        }
    }

    //Otener la variable nombre
    public function getNombre(){
        return $this->nombre;
    }
}