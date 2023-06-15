<?php

    //Creamos la clase para consultar la tabla de las consultas
    class Consultas_Modelo{

        private $db;
        private $consultas;

        public function __construct(){
            //Importamos la clase conexión para conectar con la base de datos
            require_once("conexion.php");
            //Importamos la clase paginacion para paginar los datos
            require_once("paginacion.php");
            //Almacenamos en la variable db, el resultado de la conexión
            $this->db= Conectar::Conexion();
            // la variable consultas, es una array donde almcenaremos los datos consultados.
            $this->consultas = array();

        }
        
        //Función para consultar los datos a la base de datos
        public function getConsultas(){
                //Preparamos la consulta SQL para obtener los datos totales.
                $sql = "SELECT * FROM consultas";
                $resultado = $this->db->prepare($sql);
                $resultado->execute();
                $registros_totales = $resultado->rowCount();
            //Pasamos por parámetro el nº de registros totales.
            $paginacion = new Paginacion("consultas", $registros_totales);
            //Llamamos al método realizar_paginacion
            $this->consultas = $paginacion->realizar_paginacion();
            //Devuelve un array con las consultas pra mostrarlas por pantalla
            return $this->consultas;

        }

         //Función para insertar datos a la tabla consultas
         public function insertar_Consulta($Nombre, $Email, $Telefono, $Titulo_Consulta,$Consulta){
            //Preparamos la consulta SQL
            $sql = "INSERT INTO consultas (Nombre, Email, Telefono, Titulo_Consulta, Consulta) Values (
                :nom, :email, :tel, :titulo, :msg)";
            $resultado = $this->db->prepare($sql);
            //Utilizamos marcadores
            $resultado->execute(array(":nom" => $Nombre, ":email" => $Email, ":tel" => $Telefono, ":titulo"=>$Titulo_Consulta,":msg"=>$Consulta));

        }

        //Función para eliminar datos de las consultas
        public function eliminar_Consulta($id){
            //Preparamos la consulta SQL
            $sql = "DELETE FROM consultas WHERE id=:id";
            $resultado = $this->db->prepare($sql);
            //Utilizamos marcadores
            $resultado->execute(array(":id" => $id));
            header("Location: ./controlador_consultas.php");
        }

        //Función para obtener datos de una consulta según su ID
        public function seleccionarConsultaId($id){
            //Preparamos la consulta SQL
            $sql = "SELECT * FROM consultas WHERE id = :id";
            $resultado = $this->db->prepare($sql);
            //Utilizamos marcadores
            $resultado->execute(array(":id"=>$id));
            $consulta = $resultado->fetch(PDO::FETCH_OBJ);
            //Devolvemos la consulta
            return $consulta;
        }

    }   

?>