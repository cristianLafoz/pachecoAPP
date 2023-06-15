<?php
    
    /*Verificamos que ha entrado un usuario, evitamos que un usuario invitado entre directamente a esta pçagina poniendo datos en la URL*/
    session_start();
    if(!isset($_SESSION['cargo'])){
        header("Location: ../../index.html");
    }

    //Verificamos que el usuario sea un administrador o Jefe_Comedor.
    if($_SESSION['cargo'] == "Jefe_Comedor" || $_SESSION['cargo'] == "Administrador" ){
        require_once("../Modelo/modelo_reservas.php");
        //Recogemos el valor del Id
        $id = $_GET['id'];
        //Instanciamos la clase Reservas_Modelo
        $eliminar_reserva = new Reservas_Modelo;
        //Llamamos al método eliminar_Reserva.
        $eliminar_reserva->eliminar_Reserva($id);
    
    } else {
        header("Location: ../../index.html");
    }

  

?>