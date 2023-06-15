<?php
    //Validamos que el usuario tenga la sesión correcta
    require_once('../Modelo/header.php');
    $header = new Header;

    $header->validar_session();

    
    //Recogemos los datos del formulario
    $password_antigua = htmlentities(addslashes($_POST['Password_actual']));
    $password_nueva = htmlentities(addslashes($_POST['Password_nueva']));

    //Importamos el la clase Conexion
    require_once("../Modelo/conexion.php");
    //creamos una conexion con la base de datos donde seleccionamos la información según el id
    $conexion = Conectar::Conexion();
    $sql = "SELECT * FROM trabajador WHERE id = :id";
    $resultado=$conexion->prepare($sql);
    //Ejecutamos la sentencia SQL con el ID según el valor de la sesión ID
    $resultado->execute(array(":id"=>$_SESSION['ID']));
    //Recorremos los resultados
    $registro = $resultado->fetch(PDO::FETCH_ASSOC);

    //En el caso de que haya registro, obtenemos la contraseña descifrada y la comparamos con la contraseña antigua del trabajador
    if($registro){
        if(password_verify($password_antigua, $registro['Password'])){
            //Ciframos la nueva contraseña con HASH
            $password = password_hash($password_nueva, PASSWORD_DEFAULT);
            //Creamos la sentencia SQL para actualizar
            $sql ="UPDATE trabajador SET Password = :password_nueva WHERE id= :id";
            $resultado=$conexion->prepare("$sql");
            $resultado->execute(array(":password_nueva"=>$password, ":id"=>$_SESSION['ID']));

            //Cuando se haya realizado, aparecera un mensaje de confirmación y devolvera al usuario a la pantalla de login
            echo"<script>
            alert('La contraseña actual ha sido modificada.');
            setTimeout(() => {
                window.location='../Vista/Login.html';
            }, 100);
            </script>";

        } else {
            //En caso de error, limpia el formulario y refresca la página.
            $password_antigua = "";
            $password_nueva = "";
            echo"<script>
            alert('La contraseña actual es incorrecta. Intentelo de nuevo.')
            setTimeout(() => {
                window.location='../Vista/modificar_contrasenia.php';
            }, 100);
            </script>";
        }
    }


     

?>