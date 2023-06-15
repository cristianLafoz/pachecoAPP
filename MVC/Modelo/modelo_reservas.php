<?php

    //Creamos la clase para consultar la tabla de los trabajadores
    class Reservas_Modelo{

        private $db;
        private $reservas;

        public function __construct(){
            //Importamos la clase conexión para conectar con la base de datos
            require_once("conexion.php");
            //Importamos la clase paginacion para paginar los datos
            require_once("paginacion.php");
            //Almacenamos en la variable db, el resultado de la conexión
            $this->db= Conectar::Conexion();
            //Inicializamos la variable reservas, es una array donde almcenaremos los datos consultados.
            $this->reservas = array();

        }
        
        //Función para consultar los datos a la base de datos
        public function getReservas(){
            //Preparamos la consulta SQL para obtener los datos totales.
                $sql = "SELECT * FROM reservas";
                $resultado = $this->db->prepare($sql);
                $resultado->execute();
                $registros_totales = $resultado->rowCount();
            //Pasamos por parámetro el nº de registros totales.
            $paginacion = new Paginacion("reservas", $registros_totales);
            //Llamamos al método realizar_paginacion
            $this->reservas = $paginacion->realizar_paginacion();
            //Devuelve un array con los platos pra mostrarlos por pantalla
            return $this->reservas;

        }

         //Función para insertar datos a la tabla reservas
         public function insertar_Reservas($Nombre, $Email, $Telefono, $Asistentes, $Fecha, $Hora, $Discapacidad, $Mensaje, $id_trabajador){
            //Diferenciamos el valor de discapacidad entre 0 - falso / 1 - True
            if($Discapacidad == "No"){
                $Discapacidad = 0;
            } else {
                $Discapacidad = 1;
            }
            //Preparamos la consulta SQL
            $sql = "INSERT INTO reservas (Nombre, Email, Telefono, Asistentes, Fecha, Hora, Discapacidad, Mensaje, id_trabajador) Values (
                :nom, :email, :tel, :asis, :fecha, :hora, :discapacidad, :msg, :id_trabajador)";
            $resultado = $this->db->prepare($sql);
            //Utilizamos marcadores
            $resultado->execute(array(":nom" => $Nombre, ":email" => $Email, ":tel" => $Telefono, ":asis" => $Asistentes, ":fecha" => $Fecha, ":hora"=>$Hora, ":discapacidad" => $Discapacidad, ":msg"=>$Mensaje, ":id_trabajador"=>$id_trabajador));
        }

        //Función para eliminar datos de las reservas
          public function eliminar_Reserva($id){
            //Preparamos la consulta SQL
            $sql = "DELETE FROM reservas WHERE id=:id";
            $resultado = $this->db->prepare($sql);
            //Utilizamos marcadores
            $resultado->execute(array(":id" => $id));
            //Volvemos a la página de reservas automaticamente
            header("Location: ./controlador_reservas.php");

        }

          //Función para obtener datos de una reserva según su ID
          public function seleccionarReservaId($id){
            //Preparamos la consulta SQL
            $sql = "SELECT * FROM reservas WHERE id = :id";
            $resultado = $this->db->prepare($sql);
            //Utilizamos marcadores
            $resultado->execute(array(":id"=>$id));
            $reserva = $resultado->fetch(PDO::FETCH_OBJ);
            //Devolvemos la reserva
            return $reserva;
        }

        //Función para modificar datos a la tabla trabajadores
        public function modificar_Reserva($id, $nombre, $email, $telefono, $asistentes, $fecha, $hora, $Discapacidad, $Mensaje, $id_trabajador){
            //Preparamos la consulta SQL
            $sql = "UPDATE reservas SET Nombre='$nombre', Email='$email', Telefono='$telefono', Asistentes='$asistentes', Fecha='$fecha', Hora='$hora', Discapacidad='$Discapacidad', Mensaje='$Mensaje', id_trabajador='$id_trabajador' WHERE id = '$id'";
            $resultado = $this->db->prepare($sql);
            $resultado->execute();
        }

    }

?>