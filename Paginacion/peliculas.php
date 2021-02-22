<?php

include_once 'db.php';

class Peliculas extends DB{

    private $paginaActual;//En cual pagina esta actualmente el usaurio
    private $totalPaginas;
    private $nResultados;//Conteo de todos los resultados que arroja nuestra busqueda
    private $resultadosPorPagina; //Numero de resultados que quiero mostrar por pagina
    private $indice; //Posicionar un apuntador para saber en que resultado estoy
    private $error = false;

    function __construct($nPorPagina){
        //Necesito que se inicialize tambien el constructor de la clase padre (DB)
        parent::__construct();

        $this->resultadosPorPagina = $nPorPagina;
        $this->indice = 0; //Indice de cada pelicula (todas estaran dentro de un Array)
        $this->paginaActual = 1; //Se asume que si no hay nada es la 1
        $this->calcularPaginas();
        
    }

    //Calcular pagina y actualizar valores
    function calcularPaginas(){
        //Retornar el numero total de peliculas en la BD
        $queryTotalResultados = $this->connect()->query('SELECT COUNT(*) AS total FROM pelicula');
        //Retornar un objeto con el valor de la columna 
        $this->nResultados = $queryTotalResultados->fetch(PDO::FETCH_OBJ)->total;
        //Ejemplo (15/3 = 5 paginas mostrando 3 peliculas cada una)
        $this->totalPaginas = round($this->nResultados / $this->resultadosPorPagina);

        //Asignacion de pagina actual e indice
        if(isset($_GET['pagina'])){
            //Validar que pagina sea un numero
            if(is_numeric($_GET['pagina'])){
                if($_GET['pagina'] >= 1 && $_GET['pagina'] <= $this->totalPaginas){
                    $this->paginaActual = $_GET['pagina'];
                    $this->indice = ($this->paginaActual - 1) * $this->resultadosPorPagina; //(2-1 * 3 = indice 3 y pos 4 del array)
                }else{
                    echo "No existe esa pagina";
                    $this->error = true;
                }
            }else{
                //confirmar error
                echo "error al mostrar la pagina";
                $this->error = true;
            }
        }  
    }

    function mostrarPaginas (){
        //Variable para marcar la pagina actual y darle estilo con css
        $actual = '';
        echo "<ul>";
        //Mostrar cada pagina con una lista
        for($i=0; $i < $this->totalPaginas; $i++){
            //Ver visualmente en que pagina me encuentro
            if(($i + 1) == $this->paginaActual){
                $actual = ' class="actual" ';
            }else{
                $actual = '';
            }
            echo '<li><a ' .$actual . 'href="?pagina='. ($i + 1). '">'. ($i + 1) . '</a></li>';
        }
        echo "</ul>";
    }

    function mostrarPeliculas(){
        if(!$this->error){
            //Continuar (no hubo error)
            $query = $this->connect()->prepare('SELECT * FROM pelicula LIMIT :pos, :n');  //A partir de donde quiero apuntar  
            $query->execute(['pos' => $this->indice, 'n' => $this->resultadosPorPagina]);
        
            foreach ($query as $pelicula) {
                include 'vista-pelicula.php';
            }

        }else{
            //Si hubo error
            echo "error";
        }
        
    }


}

?>