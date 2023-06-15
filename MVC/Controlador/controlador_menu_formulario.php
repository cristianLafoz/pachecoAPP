<?php

    //Validamos que el usuario tenga la sesión correcta
    require_once('../Modelo/header.php');
    $header = new Header;

    $header->validar_session();


    //Recogemos los datos de la imagen
    $nombre_imagen = $_FILES['imagen']['name'];
    $tipo_imagen = $_FILES['imagen']['type'];
    //Ruta destino en servidor xampp
    $carpeta_destino = $_SERVER['DOCUMENT_ROOT']. '/assets/img/imagenes_menus/';
    //Movemos la imagen de la carpeta temporal a la carpeta de destino final
    move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta_destino.$nombre_imagen);


    //Según sea para actualizar o para añadir
    if (isset($_POST['accion'])){
        //En caso de que sea para añadir
        if ($_POST['accion'] == 'anadir'){

            //Recogemos los valores del formulario
            $Nombre = $_POST['nombre'];
            $Descripcion = $_POST["descripcion"];
            $Tipo_Plato = $_POST["Tipo_Plato"];
            
            //Llamamos al módulo de menu
            require_once("../Modelo/modelo_menu.php");
            //Instanciamos la clase Menu_Modelo
            $nuevo_menu = new  Menu_Modelo;
            //Llamamos al método insertar_Plato, el cual requiere del parámetro imágen y la sesión actual del usuario que refleja su ID
            $nuevo_menu->insertar_Plato($nombre_imagen, $Nombre, $Descripcion, $Tipo_Plato, $_SESSION['ID']);
            //Una vez modificado se redirige al menu
            header("Location: ./controlador_menu.php");

        //En caso de que sea para modificar.
        }else if ($_POST['accion'] == 'modificar'){

            //Recogemos los datos de la URL
            $id=$_POST['id'];
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $tipo_Plato = $_POST['Tipo_Plato'];
            //Llamamos al mñodulo modelo_menu
            require_once("../Modelo/modelo_menu.php");
            //Instanciamos la clase menu_modelo
            $nuevo_menu = new Menu_Modelo;
            //Llamamos al método modificar_plato, recibirá como parámetros los datos para introducirlos en el formulario
            $nuevo_menu->modificar_Plato($id, $nombre, $descripcion, $tipo_Plato, $nombre_imagen, $_SESSION['ID']);
            //Una vez modificado se redirige al menu
            header("Location: ./controlador_menu.php");
        

        }

    }

?>