<?php


    require "../../PHPMailer/src/Exception.php";
    require "../../PHPMailer/src/PHPMailer.php";
    require "../../PHPMailer/src/SMTP.php";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP; 


    class envioEmail {
        //Funcion para enviar email cuando se realice una consulta.
        public function contactaMail($Email, $Nombre, $Consulta, $Titulo_Consulta){
            //Instanciamos clase PHP_Mailer
            $oMail= new PHPMailer();
            $oMail->isSMTP();
            //El host que vamos a utilizar es el de gmail
            $oMail->Host="smtp.gmail.com";
            //Puerto para el envío de correo en modo seguro
            $oMail->Port=587;
            //Protocolo de seguridad tls / ssl
            $oMail->SMTPSecure="tls";
            $oMail->SMTPAuth=true;
            //Usuario de google desde el que se enviará el correo
            $oMail->Username="rest.pacheco1@gmail.com";
            //Contraseña generada por gmail verificación en dos pasos
            $oMail->Password="habtkruawonijpwj";
            //Enviado desde y titulo mensaje
            $oMail->setFrom("rest.pacheco1@gmail.com", "No responder a este mensaje");
            //La dirección destino, el email que pondrá el usuario
            $oMail->addAddress($Email);
            //El titulo del email será el título de la consulta
            $oMail->Subject=$Titulo_Consulta;
            //Cuerpo del mensaje
            $oMail->msgHTML("Hola " . $Nombre . "<br>Su consulta ha sido recibida.<br><br>" . '"' . $Consulta . '"' . "<br><br>En breves nos pondremos en contacto con usted.<br><br>Un saludo.<br>Dirección Restaurante Pacheco.");
            //En caso de error
            if(!$oMail->send()){
                echo $oMail->ErrorInfo;
            }

        }

        //Funcion para enviar email cuando se realice una reserva.
        public function ReservaMail($Email, $Nombre, $Asistentes, $Fecha, $Hora, $Mensaje, $Discapacidad){
            $oMail= new PHPMailer();
            $oMail->isSMTP();
            $oMail->Host="smtp.gmail.com";
            $oMail->Port=587;
            $oMail->SMTPSecure="tls";
            $oMail->SMTPAuth=true;
            $oMail->Username="rest.pacheco1@gmail.com";
            $oMail->Password="habtkruawonijpwj";
            $oMail->setFrom("rest.pacheco1@gmail.com", "No responder a este mensaje");
            $oMail->addAddress($Email);
            $oMail->Subject="Restaurante Pacheco - Reserva confirmada.";
            $oMail->msgHTML("Hola " . $Nombre . "<br><br>Su reserva se ha relizado con éxito:<br><br>
            -Nombre Reserva: " . $Nombre . "<br>
            -Fecha: " . $Fecha . "<br>
            -Hora: " . $Hora . "<br>
            -Asistentes: " . $Asistentes . "<br>
            -Discapacidad: " . $Discapacidad . "<br><br>
            -Mensaje: " . $Mensaje . "<br><br>
            Le deseamos Bon Apetit!<br><br>
            Dirección Restaurante Pacheco.");

            if(!$oMail->send()){
                echo $oMail->ErrorInfo;
            }
                
        }

    }

?>