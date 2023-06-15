<?php

    //Recogemos los datos del formulario de consulta
    $Nombre = $_POST['Nombre'];
    $Email = $_POST["Email"];
    $Telefono = $_POST["Telefono"];
    $Titulo_Consulta = $_POST["titulo_consulta"];
    $Consulta = $_POST["Mensaje"];

    //Importamos modelos para instanciar las clases
    require_once("../Modelo/modelo_consultas.php");
    require_once("../Modelo/envio_email.php");

    //Instanciamos la clase envioEmail
    $nuevo_email = new envioEmail;
    //Llamamos al método contactaMail, mandara un email al correo del usuario que realiza una consulta
    $nuevo_email->contactaMail($Email, $Nombre, $Consulta, $Titulo_Consulta);

    //Instanciamos la clase consultas_modelo
    $nueva_consulta = new Consultas_Modelo;
    //Llamamos al método insertar_consulta. Insertara en la tabla consultas un nuevo registro.
    $nueva_consulta->insertar_Consulta($Nombre, $Email, $Telefono, $Titulo_Consulta ,$Consulta);

    echo"<script>
            alert('La consulta se ha realizado correctamente. Consulte su correo.');
            setTimeout(() => {
                window.location='../Vista/Contacta.html';
            }, 100);
        </script>";

?>