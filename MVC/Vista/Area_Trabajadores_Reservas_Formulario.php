<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Restaurante Pacheco</title>
     <!-- Importamos la biblioteca Bootstrap-->
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/area-trabajadores-style.css">
</head>
<body>
    <header>
        <div class="row ">
            <div class="col-2 h-100">
                <nav class="navbar navegacion">
                    <ul class="nav navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="../Controlador/controlador_reservas.php"> Volver </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    <?php

        //Validamos si existe la sesión
        require_once('../Modelo/header.php');
        $header = new Header;

        if(isset($_GET['id'])){
            //Comprobamos si existe un ID en la URL en caso de que exista, el usuario querrá MODIFICAR una reserva, recogemos los datos de la URL y los colocamos en el formulario
            $id = $_GET['id'];

            //Llamamos al modulo modelo_menu
            require_once("../Modelo/modelo_reservas.php");
            $reserva = new Reservas_Modelo;
            //Llamamos al método seleccionarReservaId que recoge los datos de la base de datos según el ID
            $reserva_actual = $reserva->seleccionarReservaId($id);

            //Guardamos en las variables los datos de la base de datos
            $nombre =  $reserva_actual->Nombre;
            $Email =  $reserva_actual->Email;
            $Telefono =  $reserva_actual->Telefono;
            $Asistentes =  $reserva_actual->Asistentes;
            $Fecha =  $reserva_actual->Fecha;
            $Hora =  $reserva_actual->Hora;
            $Discapacidad =  $reserva_actual->Discapacidad;
            $Mensaje = $reserva_actual->Mensaje;
        
        } else {

            //En caso de que no haya un ID en la URL, el usuario querrá AÑADIR un plato nuevo, por lo que las variables estaran vacías.
            $nombre =  "";
            $Email =  "";
            $Telefono =  "";
            $Asistentes =  "";
            $Fecha =  "";
            $Hora =  "";
            $Discapacidad =  "";
            $Mensaje = "";
        
        }

    ?>
    <main class="col-9 principal">
        <div class="container titulo">
            <h2>Formulario Reservas</h2>
        </div>
        <hr>
        <div class="d-flex justify-content-center align-items-center">
            <form class="bg-light p-5 border border-dark " method="get" action="../Controlador/controlador_reservas_formulario.php" id="formulario_reserva">
                <h2 class="mb-4">Formulario de reserva</h2>
                <div class="mb-2">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" value="<?php echo $nombre?>">
                </div>
                <div class="mb-2">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $Email?>">
                </div>
                <div class="mb-2">
                    <label for="telefono" class="form-label">Telefono</label>
                    <input class="form-control" type="tel" id="telefono" name="telefono" placeholder="Telefono" value="<?php echo $Telefono?>">
                </div>
                <div class="mb-2">
                    <label for="asistentes" class="form-label">Asistentes</label>
                    <input type="number" class="form-control" id="asistentes" name="asistentes" placeholder="Asistentes" min="1" max="10" value="<?php echo $Asistentes?>">
                </div>
                <div class="mb-2">
                    <label for="fecha" class="form-label">Fecha</label>
                    <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo $Fecha?>">
                </div>
                <div class="mb-2">
                    <label for="fecha" class="form-label">Hora</label><br>
                    <label>Seleccione una hora entre las 14:00 - 22:00, en intervalos de 30 minutos.</label>
                    <input type="time" class="form-control" id="hora" name="hora" value="<?php echo $Hora?>">
                </div>
                <div class="discapacidad">
                    <label class="control-label">Indique si en la reserva hay alguien con algún tipo de discapacidad:</label>
                    <div class="form-check">
                      <label class="form-check-label">
                        <input id="discapacidadSi" type="radio" name="discapacidad" class="form-check-input" value=1 <?php if($Discapacidad == 1) echo 'checked';?>>Si
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="form-check-label">
                        <input id="discapacidadNo" type="radio" name="discapacidad" class="form-check-input" value=0 <?php if($Discapacidad == 0) echo 'checked';?>>No
                      </label>
                    </div>
                </div>
                <div class="mb-3">
                    <textarea class="form-control" id="message" name="message" rows="6" placeholder="Introduzca un mensaje opcional"><?php echo $Mensaje?></textarea>
                </div>
                <input type="hidden" name="id" value="<?php echo isset($_GET['id'])? $id : "";?>">
                <input type="hidden" name="accion" value="<?php echo isset($_GET['id']) ? 'modificar' : 'anadir'; ?>">
                <button class="btn btn-primary d-block w-100" id="Aniadir" type="submit" style="background: rgb(217,144,54);"><?php echo isset($_GET['id']) ? 'Actualizar' : 'Añadir';?></button>
            </form>
        </div>
    </main>
    <script type="module" src="./js/formulario_reserva.js"></script>
</body>
</html>