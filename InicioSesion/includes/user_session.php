<?php
    //Ambiente de sesiones
    class UserSession{

        //Poder identificar las sesiones o los valores qu eestamos modificando o creando 
        //Ambiente de sesiones
        public function __construct(){
            session_start();
        }
        //Ayuda a ponerle un valor a la sesion actual
        public function setCurrentUser($user){
            //Guardar valores para la sesion (nombre del usuario)
            $_SESSION['user'] = $user;
        }
        //devolver el valor de la sesion del usuario
        public function getCurrentUser(){
            return $_SESSION['user'];
        }
        //Cerrar la sesion
        public function closeSession(){
            session_unset();
            session_destroy();
        }
    }