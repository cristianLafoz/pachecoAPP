<?php

    class Paginacion{
        //Declaramos las variables que necesitaremos utilizar
        private $valor_orden;
        private $db;
        private $pagina_actual;
        private $registros_pagina;
        private $registros_totales;
        private $paginas_totales;
        private $resultado_desde;
        private $sql_limitada;
        private $base;
        private $array;
 
        public function __construct($db, $registros_totales){

            require_once("conexion.php");
            $this->base = Conectar::Conexion();

            //Obtenemos el valor de la URL, en caso de que no hayamos ordenado, ordenara por Nombre
            $this->valor_orden = $_GET['valor']??"Nombre";
            //Declaramos la tabla de la base de datos que utilizaremos para paginar
            $this->db = $db;
            //Declaramos el valor de registros totales 
            $this->registros_totales = $registros_totales;
            //Declaramos el valor de registros por pagina
            $this->registros_pagina = 10;
            //Declaramos el valor de la primera página
            $this->pagina_actual = 1;
            $this->array = array();

        }

        public function realizar_paginacion(){
            //Obtenemos el valor "pagina_actual" de la URL, en caso de que no exista, ponemos de valor 1
            if(isset($_GET["pagina_actual"])){
                $this->pagina_actual = $_GET["pagina_actual"];
            }else {
                $this->pagina_actual = 1;
            }
            //Obtenemos el número de páginas totales que vamos a necesitar, lo aproximamos hacia el número superior
            $this->paginas_totales = ceil($this->registros_totales/$this->registros_pagina);
            //Obtenemos los intervalos de resultados según el número de página donde nos encontremos
            $this->resultado_desde = ($this->pagina_actual-1)*$this->registros_pagina;
            //Obtenemos la consulta SQL para conocer el total de resultados - LIMIT el resultado desde = el registro será 0,10,20 ...
            //El registros_pagina, el número de datos a obtener desde el resultado_desde. -> resultado_desde + 10
            $this->sql_limitada = "SELECT * FROM " . $this->db . " ORDER BY " . $this->valor_orden . " LIMIT " . $this->resultado_desde . "," . $this->registros_pagina;
            $resultado = $this->base->prepare($this->sql_limitada);
            $resultado->execute();

            while($fila = $resultado->fetch(PDO::FETCH_OBJ)){

                $this->array[] = $fila;

            }
            //Devolvemos los datos en el array
            return $this->array;

        }

        public static function getPaginasTotales($db, $registros_pagina){
            require_once("conexion.php");
            $base = Conectar::Conexion();
            //Preparamos la consulta SQL para obtener los datos totales.
            $sql = "SELECT * FROM " . $db;
            $resultado =  $base->prepare($sql);
            $resultado->execute();
            $registros_totales = $resultado->rowCount();
            
            //Calculamos el número de páginas totales y lo devolvemos
            $paginas_totales = ceil($registros_totales/$registros_pagina);

            return $paginas_totales;
        }

    }



?>