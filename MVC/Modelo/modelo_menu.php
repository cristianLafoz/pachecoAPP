<?php

    //Creamos la clase para consultar la tabla de los trabajadores
    class Menu_Modelo{

        private $db;
        private $platos;

        public function __construct(){
            //Importamos la clase conexión para conectar con la base de datos
            require_once("conexion.php");
            //Importamos la clase paginacion para paginar los datos
            require_once("paginacion.php");
            //Almacenamos en la variable db, el resultado de la conexión
            $this->db= Conectar::Conexion();
            //Inicializamos la variable reservas, es una array donde almcenaremos los datos consultados.
            $this->platos = array();

        }
        
        //Función para consultar los datos a la base de datos
        public function getPlatos(){
            //Preparamos la consulta SQL para obtener los datos totales.
                $sql = "SELECT * FROM platos";
                $resultado = $this->db->prepare($sql);
                $resultado->execute();
                $registros_totales = $resultado->rowCount();
            //Pasamos por parámetro el nº de registros totales.
            $paginacion = new Paginacion("platos", $registros_totales);
            //Llamamos al método realizar_paginacion
            $this->platos = $paginacion->realizar_paginacion();
            //Devuelve un array con los platos pra mostrarlos por pantalla
            return $this->platos;
        }

        //Función para insertar datos a la tabla menu
        //El parámetro $Nombre_Imagen, será necesario ya que se trata de una ruta donde guardaremos la imagen que suba el usuario
        public function insertar_Plato($Nombre_Imagen, $Nombre, $Descripcion, $Tipo_Plato, $id_trabajador){
            //Preparamos la consulta SQL
            $sql = "INSERT INTO platos (Nombre, Descripcion, Tipo_Plato, id_trabajador, Foto) Values (
                :nom, :descripcion, :TipoPlato, :id_trabajador, :Foto)";
            $resultado = $this->db->prepare($sql);
            //Utilizamos marcadores  
            $resultado->execute(array(":nom" => $Nombre, ":descripcion" => $Descripcion, ":TipoPlato" => $Tipo_Plato, ":id_trabajador"=> $id_trabajador,":Foto"=>$Nombre_Imagen));
        }

        //Función para eliminar datos de los platos
        public function eliminar_Plato($id){
            //Preparamos la consulta SQL
            $sql = "DELETE FROM platos WHERE id=:id";
            $resultado = $this->db->prepare($sql);
            //Utilizamos marcadores
            $resultado->execute(array(":id" => $id));
            header("Location: ./controlador_menu.php");
        }

        //Función para obtener datos de una reserva según su ID
        public function seleccionarPlatoId($id){
            //Preparamos la consulta SQL
            $sql = "SELECT * FROM platos WHERE id = :id";
            $resultado = $this->db->prepare($sql);
            //Utilizamos marcadores
            $resultado->execute(array(":id"=>$id));
            $plato = $resultado->fetch(PDO::FETCH_OBJ);
            //Devolvemos el plato seleccionado
            return $plato;
        }

        //Función para modificar datos a la tabla trabajadores
        public function modificar_Plato($id, $nombre, $descripcion, $Tipo_Plato, $Foto, $id_trabajador){
            //Preparamos la consulta SQL
            $sql = "UPDATE platos SET Nombre='$nombre', Descripcion='$descripcion', Tipo_Plato='$Tipo_Plato', Foto='$Foto', id_trabajador='$id_trabajador' WHERE id = '$id'";
            $resultado = $this->db->prepare($sql);
            $resultado->execute();
        }
        

       
    }

?>