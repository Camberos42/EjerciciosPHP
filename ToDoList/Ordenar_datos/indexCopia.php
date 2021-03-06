<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Obtener datos</title>
    <link rel="stylesheet" href="/css/main.css">
</head>
<body>
    <form action="index.php" method="POST">
        <input type="text" name="texto" id="texto">
        <input type="submit" value="Añadir pendiente">
    </form>

    <div id="mostrar-todo-container">
            <form id="formMostrarTodo" action="index.php" method="POST">
                <input type="checkbox" name="mostrar-todo" onchange="mostrarTodo(this)" 
                <?php if(isset($_POST['mostrar-todo'])) {
                    if($_POST['mostrar-todo'] == "on"){
                        echo " checked";
                    }
                    } ?>> Mostrar todo
            </form>
        </div>

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

            //Validar si existe mostrar-todo
            $sql = "";
            if(isset($_POST['mostrar-todo'])){
                $ordenar = $_POST['mostrar-todo'];

                //Si ordenar esta on se ordenara 
                if($ordenar == "on"){
                    $sql = "SELECT * FROM todoTable ORDER BY completado DESC";   
            }else{
                //Si es off se ejecutara la siguiente sentencis
                $sql = "SELECT * FROM todoTable WHERE completado = 0";
            }


            //Obtención de datos de tabla
            $sql = "SELECT * FROM todoTable  WHERE completado = 0";
            $resultado = $conexion->query($sql);

            if($resultado->num_rows > 0){
                //echo $resultado->num_rows;
                while($row = $resultado->fetch_assoc()){
                    //Imprimir los valores 
                    ?>
                    <div class="pendiente">
                            <form method="POST" class="form_actualizar" id="form<?php echo $row['id']; ?>" action="">
                                <input name ="completar" value="<?php echo $row['id']; ?>" id="<?php echo $row['id']; ?>" 
                                type="checkbox" onchange="completarPendiente(this)" <?php if($row['completado'] == 1) echo " checked disabled"; ?>>
                                <div class="texto <?php if($row['completado'] == 1) echo " deshabilitado"; ?>"><?php echo $row['texto'];?></div>
                            </form>
                            <form method="POST" class="form_eliminar" action="index.php">
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
        let formulario = document.getElementById(id);
        formulario.submit();
        //console.log(id);
        
    }

    function mostrarTodo(e){
            let formulario = document.getElementById("formMostrarTodo");
            formulario.submit();
        }
</script>

</html>