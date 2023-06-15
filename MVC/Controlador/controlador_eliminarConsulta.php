<?php

    /*Verificamos que ha entrado un usuario, evitamos que un usuario invitado entre directamente a esta pçagina poniendo datos en la URL*/
    session_start();
    if(!isset($_SESSION['cargo'])){
        header("Location: ../Vista/pagina_error.html");
    }
    
    //Verificamos que el usuario sea un administrador.
    if($_SESSION['cargo'] == "Administrador" ){
        //Recogemos el valor del Id
        $id = $_GET['id'];
        
        require_once("../Modelo/modelo_consultas.php");
        //Instanciamos la clase consultas_modelo
        $eliminar_consulta = new Consultas_Modelo;
        //Llamamos al método eliminar_consulta
        $eliminar_consulta->eliminar_Consulta($id);
        //Si no lo es, redirigimos al index.html
    } else {
        header("Location: ../../index.html");
    }


?>