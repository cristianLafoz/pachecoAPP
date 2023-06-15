<?php

    //Creamos la clase para consultar la tabla de los trabajadores
    class Trabajadores_Modelo{

        private $db;
        private $trabajadores;

        public function __construct(){
            //Importamos la clase conexión para conectar con la base de datos
            require_once("conexion.php");
            //Importamos la clase paginacion para paginar los datos
            require_once("paginacion.php");
            //Almacenamos en la variable db, el resultado de la conexión
            $this->db= Conectar::Conexion();
            //Inicializamos la variable trabajadores, es una array donde almcenaremos los datos consultados.
            $this->trabajadores = array();

        }
        
        //Función para consultar los datos a la base de datos
        public function getTrabajadores(){
            //Preparamos la consulta SQL para obtener los datos totales.
                $sql = "SELECT * FROM trabajador";
                $resultado = $this->db->prepare($sql);
                $resultado->execute();
                $registros_totales = $resultado->rowCount();
            //Pasamos por parámetro el nº de registros totales.
            $paginacion = new Paginacion("trabajador", $registros_totales);
            //Llamamos al método realizar_paginacion
            $this->trabajadores = $paginacion->realizar_paginacion();
            //Devolvemos el array trabajadores para mostrarlos por pantalla
            return $this->trabajadores;

        }

        //Función para insertar datos a la tabla trabajadores
        public function insertar_Trabajadores($Nombre, $Apellido1, $Apellido2, $email, $Cargo, $contra){
            //Encriptamos la contraseña introducida en el formulario
            $Password=password_hash($contra, PASSWORD_DEFAULT);

            //Contrastamos si el usuario ya existe según el email proporcionado
            $consulta = "SELECT * FROM trabajador WHERE Email = :email";
            $stmt = $this->db->prepare($consulta);
            $stmt->execute(array(":email" => $email));
            
            //En caso de que exista, reenviará a la tabla con los trabajadores
            if ($stmt->rowCount() > 0) {
                header("Location: ./controlador_trabajadores.php");
                return;
            }
            //En caso de que no exista introducimos los datos en la base de datos
            // Insertamos el nuevo usuario
            try {
                //Preparamos la consulta SQL y la ejecutamos
                $sql = "INSERT INTO trabajador (Nombre, Primer_Apellido, Segundo_Apellido, Email, Tipo_Cargo, Password) VALUES (:nombre, :apellido1, :apellido2, :email, :cargo, :pass)";
                $resultado = $this->db->prepare($sql);
                $resultado->execute(array(":nombre" => $Nombre, ":apellido1"=>$Apellido1, "apellido2"=> $Apellido2, ":email"=>$email, ":cargo"=>$Cargo,":pass"=>$Password));
                //Una vez introducido volvemos al area de los trabajadores
                header("Location: ./Trabajadores/controlador_trabajadores.php");

            } catch (PDOException $e) {
                echo "Error al insertar el trabajador: " . $e->getMessage();
                echo "Linea Error: " . $e->getLane();
            }
            
        }

          //Función para eliminar datos de los trabajadores
          public function eliminar_Trabajador($id){
            //Preparamos la consulta SQL
            $sql = "DELETE FROM trabajador WHERE id=:id";
            $resultado = $this->db->prepare($sql);
            //Utilizamos marcadores
            $resultado->execute(array(":id" => $id));
            //Volvemos al area de los trabajadores
            header("Location: ./controlador_trabajadores.php");

        }

        //Función para obtener datos de un trabajdor según su ID
        public function seleccionarTrabajadorId($id){
            //Preparamos la consulta SQL
            $sql = "SELECT * FROM trabajador WHERE id = :id";
            $resultado = $this->db->prepare($sql);
            //Utilizamos marcadores
            $resultado->execute(array(":id"=>$id));
            $trabajador = $resultado->fetch(PDO::FETCH_OBJ);
            //Devolvemos el valor del trabajador
            return $trabajador;
        }

        //Función para modificar datos a la tabla trabajadores
        public function modificar_Trabajador($id, $nombre, $apellido1, $apellido2, $email, $cargo){
            //Preparamos la consulta SQL
            $sql = "UPDATE trabajador SET Nombre='$nombre', Primer_Apellido = '$apellido1', Segundo_Apellido = '$apellido2', Email='$email', Tipo_Cargo = '$cargo' WHERE id = '$id'";
            $resultado = $this->db->prepare($sql);
            $resultado->execute();
        }


    }   

?>