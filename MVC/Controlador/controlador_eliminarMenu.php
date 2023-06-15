<?php

    /*Verificamos que ha entrado un usuario, evitamos que un usuario invitado entre directamente a esta pçagina poniendo datos en la URL*/
    session_start();
    if(!isset($_SESSION['cargo'])){
        header("Location: ../../index.html");
    }
    //Verificamos que el usuario sea un administrador o Jefe_Cocina.
    if($_SESSION['cargo'] == "Jefe_Cocina" || $_SESSION['cargo'] == "Administrador" ){
        //Recogemos el valor del formulario
        $id = $_GET['id'];
        
        require_once("../Modelo/modelo_menu.php");
        //Instanciamos la clase Menu_Modelo
        $eliminar_plato = new Menu_Modelo;
        //Llamamos al método eliminar_plato
        $eliminar_plato->eliminar_Plato($id);

    } else {
        header("Location: ../../index.html");
    }
    


?>