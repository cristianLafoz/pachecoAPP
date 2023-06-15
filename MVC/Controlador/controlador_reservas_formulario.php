<?php
    
    session_start();

    if (isset($_GET['accion'])){
        $accion = $_GET['accion'];
        //Diferenciamos entre una nueva entrada o modificar una ya existente
        if ($accion == 'anadir'){
            //Recogemos los datos del formulario
            $Nombre = $_GET['nombre'];
            $Email = $_GET["email"];
            $Telefono = $_GET["telefono"];
            $Asistentes = $_GET["asistentes"];
            $Fecha = $_GET["fecha"];
            $Hora = $_GET["hora"];
            $Discapacidad = $_GET["discapacidad"];
            $Mensaje = $_GET["message"];
            //Llamamos a los modulos modelo_reservas y al protocolo SMTP para el envío del email
            require_once("../Modelo/modelo_reservas.php");
            require_once("../Modelo/envio_email.php");

            //Instanciamos la clase envioEmail
            $nuevo_email = new envioEmail;
            //Llamamos al método contactaMail, mandara un email al correo del usuario que realiza una consulta
            $nuevo_email->ReservaMail($Email, $Nombre, $Asistentes, $Fecha, $Hora, $Mensaje, $Discapacidad);
            //Instanciamos la clase Reservas_Modelo
            $nueva_reserva = new Reservas_Modelo;
            //Declaramos el valor de la variable "reserva_solicitada", en caso de que no haya sesión, habrá sido un cliente anónimo, PONDREMOS EL VALOR 51 el cual se encuentra en la base de datos
            // en la tabla trabajadores, un trabajador con dicho nombre
            $reserva_solicitada=isset($_SESSION['ID'])?$_SESSION['ID']:51;
            //Llamamos al método Insertar_Reservas, recibira por parámetros los valores que hay que insertar.
            $nueva_reserva->insertar_Reservas($Nombre, $Email, $Telefono, $Asistentes, $Fecha, $Hora, $Discapacidad, $Mensaje, $reserva_solicitada);
            //En caso de que sea añadida por un trabajador, se redirige a la zona de los trabajadores.
            if(isset($_SESSION['cargo'])){
                header("Location: ./controlador_reservas.php");
            }else {
                echo"<script>
                    alert('La consulta se ha realizado correctamente. Consulte su correo.');
                    setTimeout(() => {
                        window.location='../Vista/Reserva.html';
                    }, 100);
                </script>";
            }

        }else if ($accion == 'modificar'){
            //Recogemos los datos y los almacenamos en variables
            $id=$_GET['id'];
            $nombre=$_GET['nombre'];
            $email=$_GET['email'];
            $telefono=$_GET['telefono'];
            $asistentes=$_GET['asistentes'];
            $fecha=$_GET['fecha'];
            $hora=$_GET['hora'];
            $Discapacidad = $_GET["discapacidad"];
            $Mensaje = $_GET["message"];

            //Llamamos al modulo modelo_reservas
            require_once("../Modelo/modelo_reservas.php");
            //Instanciamos la clase y llamamos al método modificar, recibira por parámetros los valores que hay que modificar.
            $nueva_reserva = new Reservas_Modelo;
            $nueva_reserva->modificar_Reserva($id, $nombre, $email, $telefono, $asistentes, $fecha, $hora, $Discapacidad, $Mensaje, $_SESSION['ID']);
            //Al modificar, solo pueden los trabajadores, por lo que no hace falta diferenciar entre sesiones.
            header("Location: ./controlador_reservas.php");
        
        }

    }

?>