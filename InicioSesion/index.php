<?php
    include_once 'includes/user.php';
    include_once 'includes/user_session.php';

    //Inicializar el ambiente de sesiones
    $userSession = new UserSession();

    //Manejar el usuario actual
    $user = new User();

    //Validaciones (dependiendo de la condicion redireccionara a diferente lado)
    if(isset($_SESSION['user'])){
        echo "Hay sesión";
        /*El user se vuelve a construir para mantener abierta la sesion (devolvera la sesion de user 
        y lo pasara a setUser para crear la conexion a la base de datos y rellenar las variables) */
        $user->setUser($userSession->getCurrentUser());
        include_once 'vistas/home.php';
        
    }else if(isset($_POST['username']) && isset($_POST['password'])){
        echo "Validación de login";
    
        //Almaceno las variables 
        $userForm = $_POST['username'];
        $passForm = $_POST['password'];

        //Entrar a la BD y validar si existe la base de datos (funcion que creamos en clase user)
        if($user->userExists($userForm, $passForm)){
            //echo "usuario validado";

            //Guardas las propiedades del objeto user para usarlas en la session
            $userSession->setCurrentUser($userForm);
            $user->setUser($userForm);
    
            include_once 'vistas/home.php';
        }else{
            //echo "nombre de usuario y/o password incorrecto";
            $errorLogin = "Nombre de usuario y/o password es incorrecto"; //Mensaje en el frontend
            include_once 'vistas/login.php'; //Si los datos son incorrectos redirecicona al login
            }
    
    }else{
        echo "Login";
        include_once 'vistas/login.php';
    }

?>