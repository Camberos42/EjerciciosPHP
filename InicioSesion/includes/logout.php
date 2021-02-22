<?php
    include_once 'user_session.php';

    //Ambiente de sesiones
    $userSession = new UserSession();
    
    //Cerrar la sesion 
    $userSession->closeSession();

    //Regresar a pagina de inicio 
    header("location: ../index.php");

?>