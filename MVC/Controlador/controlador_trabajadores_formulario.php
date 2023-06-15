<?php

    //Según sea para actualizar o para añadir
    if (isset($_POST['accion'])){
        $accion = $_POST['accion'];
        //En caso de que sea para añadir
        if ($accion == 'anadir'){

            //Recogemos los datos del formulario
            $Nombre = $_POST['nombre'];
            $Apellido1 = $_POST["apellido1"];
            $Apellido2 = $_POST["apellido2"];
            $email = htmlentities(addslashes($_POST['email']));
            $Cargo = $_POST["cargo"];
            $contra = htmlentities(addslashes($_POST["password"]));

            //Instanciamos la clase modelo_trabajador junto con el método insertar_Trabajador.
            require_once("../Modelo/modelo_trabajadores.php");
            $nuevo_trabajador = new Trabajadores_Modelo;
            $nuevo_trabajador->insertar_Trabajadores($Nombre, $Apellido1, $Apellido2, $email, $Cargo, $contra);
            

        //En caso de que sea para modificar.
        }else if ($accion == 'modificar'){

            //Recogemos los datos del formulario
            $id=$_POST['id'];
            $nombre = $_POST['nombre'];
            $apellido1 = $_POST['apellido1'];
            $apellido2 = $_POST['apellido2'];
            $email = $_POST['email'];
            $cargo = $_POST['cargo'];

            //Instanciamos la clase modelo_trabajador junto con el método insertar_Trabajador.
            require_once("../Modelo/modelo_trabajadores.php");
            $nuevo_trabajador = new Trabajadores_Modelo;
            $nuevo_trabajador->modificar_Trabajador($id, $nombre, $apellido1, $apellido2, $email, $cargo);

        }

    }

    header("Location: ./controlador_trabajadores.php");

   
?>