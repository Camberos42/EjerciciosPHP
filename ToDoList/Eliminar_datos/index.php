<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Obtener datos</title>
</head>
<body>
    <form action="index.php" method="POST">
        <input type="text" name="texto" id="texto">
        <input type="submit" value="Añadir pendiente">
    </form>

    <div id="todolist">
        <?php
            $servidor = "localhost";
            $user = "root";
            $password = "123456";
            $db = "todolistdb";

            $conexion = new mysqli($servidor, $user, $password, $db);

            if($conexion->connect_error){
                die("Conexion fallida". $conexion->connect_error);
            }

            if(isset($_POST['texto'])){
                $texto = $_POST['texto'];

                $sql = "INSERT INTO todotable(texto,completado) VALUES('$texto', false)";
                
                if($conexion->query($sql) === true){
                    //echo '<div><form action=""><input type="checkbox">'.$texto.'</form></div>';
                }else{
                    die("Error al insertar datos: " . $conexion->error);
                }
            }
            else if(isset($_POST['completar'])){
                $id = $_POST['completar'];

                $sql = "UPDATE todoTable SET completado = 1 WHERE id = $id";

                if($conexion->query($sql) === true){
                    //echo '<div><form action=""><input type="checkbox">'.$texto.'</form></div>';
                }else{
                    die("Error al actualizar datos: " . $conexion->error);
                } 
            }
            
            else if(isset($_POST['eliminar'])){
                $id = $_POST['eliminar'];

                $sql = "DELETE FROM todoTable WHERE id = $id";

                if($conexion->query($sql) === true){
                    //echo '<div><form action=""><input type="checkbox">'.$texto.'</form></div>';
                }else{
                    die("Error al actualizar datos: " . $conexion->error);
                } 
            }

            //Obtención de datos de tabla
            $sql = "SELECT * FROM todoTable  WHERE completado = 0";
            $resultado = $conexion->query($sql);

            if($resultado->num_rows > 0){
                //echo $resultado->num_rows;
                while($row = $resultado->fetch_assoc()){
                    //Imprimir los valores 
                    ?>
                    <div>
                        <form method="POST" id="form<?php echo $row['id']; ?>" action="">
                            <input name ="completar" value="<?php echo $row['id']; ?>" id="<?php echo $row['id']; ?>" type="checkbox" onchange="completarPendiente(this)"><?php echo $row['texto'];?>
                        </form>
                        <form method="POST" id="form_eliminar_<?php echo $row['id']; ?>" action="index.php">
                            <input type="hidden" name="eliminar" value="<?php echo $row['id']; ?>"  />
                            <input type="submit" value="Eliminar">
                        </form>
                    </div>
                    <?php
                    
                }
            }

            $conexion->close();

        ?>
    </div>
    
</body>
<script>
    function completarPendiente(e) {
        let id = "form" + e.id;
        var formulario = document.getElementById(id);
        formulario.submit();
        //console.log(id);
        
    }
</script>

</html>