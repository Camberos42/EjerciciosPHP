<?php
    $servidor = "localhost";
    $user = "root";
    $password = "123456";
    $db = "todolistdb";

    $conexion = new mysqli($servidor, $user, $password, $db);

    if($conexion->connect_error){
        die("Conexion fallida". $conexion->connect_error);
    }

    //Sentencia de la creacion de la base de datos (Almacenada en variabale $sql)
    /*$sql = "CREATE DATABASE ToDoListDB";

    if($conexion->query($sql) === true){
        echo "Base de datos creada con exito";
    }else{
        die("Error al crear base de datos " . $conexion->error);
    }*/

    //Sentencia creacion de tabla
    /*$sql = "CREATE TABLE todoTable(
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        texto VARCHAR (100) NOT NULL,
        completado BOOLEAN NOT NULL,
        timestamp TIMESTAMP
    )"; */  

    if($conexion->query($sql) === true){
        echo "Base de datos creada con exito";
    }else{
        die("Error al crear tabla en BD" . $conexion->error);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar datos</title>
</head>
<body>
    
</body>
</html>