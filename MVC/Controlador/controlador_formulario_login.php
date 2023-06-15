<?php

    //Llamamos al modulo de conexion
    require_once("../Modelo/conexion.php");
    //Llamamos al método static conexión
    $conexion = Conectar::Conexion();

    // Obtenemos los valores del formulario
    $email = htmlentities(addslashes($_POST['email']));
    $password =  htmlentities(addslashes($_POST['password'])); 
    //Creamos la consulta SQL que verificará que el email puesto por el usuario se encuentra en la base de datos "trabajador"
    $sql = "SELECT * FROM trabajador WHERE Email =:email";
    $resultado = $conexion->prepare($sql);
    $resultado->execute(array(":email"=>$email));
    $registro = $resultado->fetch(PDO::FETCH_ASSOC);
    //Si encuentra datos, existe el email
    if($registro){
        //Diferenciamos la contraseña introducida por el usuario con la contraseña de la base de datos
        if(password_verify($password, $registro['Password'])){
             /*El usuario existe en la base de datos, otorgamos la sesión correspondiente según su cargo
             Guardamos en otra sesión el valor de su ID*/
             session_start();
             $_SESSION['cargo'] = $registro['Tipo_Cargo'];
             $_SESSION['ID'] = $registro['id'];
 
             // Verificamos el tipo de cargo del usuario y redirigimos a la página correspondiente
             if ($_SESSION['cargo'] == 'Administrador') {
                 header('Location: ./controlador_trabajadores.php?');
             } elseif ($_SESSION['cargo'] == 'Camarero') {
                 header('Location: ./controlador_reservas.php');
             } elseif ($_SESSION['cargo'] == 'Jefe_Comedor') {
                 header('Location: ./controlador_reservas.php');
             }elseif ($_SESSION['cargo'] == 'Cocinero') {
                 header('Location: ./controlador_menu.php');
             }elseif ($_SESSION['cargo'] == 'Jefe_Cocina') {
                 header('Location: ./controlador_menu.php');
             }else {
                 header('Location: ../Vista/Login.html');
             }          
        } else {
            //No se encontró ningún registro con el correo electrónico proporcionado
            header("Location:../Vista/pagina_error_login.html");
        }
        //Si no encuentra datos, redirige al formulario de login nuevamente.
    } else {
        //No se encontró ningún registro con el correo electrónico proporcionado
        header("Location:../Vista/pagina_error_login.html");
    }

?>