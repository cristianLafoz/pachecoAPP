<?php

//Clase header que importaremos en los headers de los archivos de vista "area_trabajadores", realizará la recogida de sesión del usuario, según sesión se visualizarán
//unos enlaces u otros.
class Header{

    private $db;

    public function __construct(){
        //Iniciamos la sesión
        session_start();
        //En caso de que la sesión no exista, no permitimos la entrada.
        if(!isset($_SESSION['cargo'])){
            header("Location:../Vista/pagina_error.html");
        }

        //Importamos la clase conexión para conectar con la base de datos
        require_once("conexion.php");

        //Almacenamos en la variable db, el resultado de la conexión
        $this->db= Conectar::Conexion();

    }

    public function validar_session(){
        //Preparamos la consulta SQL para conocer el nombre y ponerlo en la cabecera
        $sql = "SELECT Nombre FROM trabajador WHERE id = :id";
        $resultado = $this->db->prepare($sql);
        $resultado->execute(array(":id" => $_SESSION['ID']));
        $registro = $resultado->fetch(PDO::FETCH_ASSOC);
        //Guardamos el valor Nombre en una variable
        $nombre_usuario = $registro['Nombre'];
 
        echo 
        '
        <header>
        <div class="row">
                <div class="col-2">
                    <nav class="navbar navegacion">
                        <ul class="nav navbar-nav">
                            <div class="text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-person">
                                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"></path>
                                </svg>
                                <h5>Hola, ' .$nombre_usuario .'</h5>
                                <a class="btn btn-secondary btn-sm" href="../Controlador/controlador_cerrar_sesion.php">Cerrar sesión</a><br>
                                <a class="btn btn-secondary btn-sm" href="../Vista/modificar_contrasenia.php">Modificar Contraseña</a>
                            </div>
                        <li class="nav-item">
                            <a class="nav-link" href="../../index.html"> Restaurante </a>
                        </li>';
                        if($_SESSION['cargo'] == "Camarero" || $_SESSION['cargo'] == "Administrador" || $_SESSION['cargo'] == "Jefe_Comedor"){
                        echo'<li class= nav-item">
                                <a class="nav-link" href="./controlador_reservas.php"> Reservas </a>
                            </li>';
                            }                        
                        if($_SESSION['cargo'] == "Cocinero" || $_SESSION['cargo'] == "Administrador" || $_SESSION['cargo'] == "Jefe_Cocina"){
                            echo'<li class="nav-item">
                                <a class="nav-link" href="./controlador_menu.php"> Menús </a>
                            </li>';
                            }
                         if($_SESSION['cargo'] == "Administrador"){
                            echo'<li class="nav-item">
                                <a class="nav-link" href="./controlador_trabajadores.php"> Trabajadores </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="./controlador_consultas.php"> Consultas </a>
                            </li>';
                            }
                        echo'  
                        </ul>
                    </nav>
                </div>
            </div>
        </header> 
       ';

    }

    //Método para obtener el ID, para modificar la contraseña
    public function obtenerId(){
        //Preparamos la consulta SQL para conocer el nombre
        $sql = "SELECT id FROM trabajador WHERE id = :id";
        $resultado = $this->db->prepare($sql);
        $resultado->execute(array(":id" => $_SESSION['ID']));
        $registro = $resultado->fetch(PDO::FETCH_ASSOC);
        //Guardamos el valor Nombre en una variable
        return $registro['id'];
    }


}



?>