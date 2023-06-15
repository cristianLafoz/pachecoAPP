<?php
    /*Verificamos que ha entrado un usuario, evitamos que un usuario invitado entre directamente a esta pçagina poniendo datos en la URL*/
    session_start();
    if(!isset($_SESSION['cargo'])){
        header("Location: ../../index.html");
    }

    //Verificamos que el usuario sea un administrador.
    if($_SESSION['cargo'] == "Administrador" ){
        //Recogemos los datos del formulario
        $id = $_GET['id'];
        
        require_once("../Modelo/modelo_trabajadores.php");
        //Instanciamos la clase Trabajadores_Modelo
        $eliminar_trabajador = new Trabajadores_Modelo;
        //Llamamos al método eliminar_Trabajador.
        $eliminar_trabajador->eliminar_Trabajador($id);
        
    }else {
        header("Location: ../../index.html");
    }
    

?>