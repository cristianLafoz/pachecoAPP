<?php
    //Recogemos el valor de la sesión
    session_start();
    // Eliminamos la sesión tipo_cargo y devolvemos al trabajador a la página de login.html
    session_destroy();
    header("Location: ../Vista/Login.html");

?>