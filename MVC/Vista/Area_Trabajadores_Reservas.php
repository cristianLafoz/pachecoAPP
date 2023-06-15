<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Restaurante Pacheco</title>
     <!-- Importamos la biblioteca Bootstrap-->
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Vista/css/area-trabajadores-style.css">
</head>
<body>
    <?php
        require_once('../Modelo/header.php');
        $header = new Header;

        //En caso de que la sesion de cargo no sea la requerida te envía a la página de error
        //Prevenimos que trabajadores con otro cargo, entren en zonas no habilitadas.
        if($_SESSION['cargo'] != "Administrador" && $_SESSION['cargo'] != "Camarero" && $_SESSION['cargo'] != "Jefe_Comedor"){
            header("Location:../Vista/pagina_error.html");
        }


        $header->validar_session();

    ?>
    <main class="col-10 principal">
        <div class="container titulo">
            <h2>Reservas del Restaurante</h2>
        </div>
        <hr>
        <div class="container">
            <table class="table">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col" class="text-center" style="Display:None;">Id</th>
                    <th scope="col" class="text-center"><a style="color:black; cursor:pointer; text-decoration:none;" href="<?php echo $_SERVER['PHP_SELF'].'?valor=Nombre&pagina_actual=1';?>">Nombre Titular Reserva</a></th>
                    <th scope="col" class="text-center"><a style="color:black; cursor:pointer; text-decoration:none;" href="<?php echo $_SERVER['PHP_SELF'].'?valor=Email&pagina_actual=1';?>">Email</a></th>
                    <th scope="col" class="text-center"><a style="color:black; cursor:pointer; text-decoration:none;" href="<?php echo $_SERVER['PHP_SELF'].'?valor=Telefono&pagina_actual=1';?>">Teléfono</a></th>
                    <th scope="col" class="text-center"><a style="color:black; cursor:pointer; text-decoration:none;" href="<?php echo $_SERVER['PHP_SELF'].'?valor=Asistentes&pagina_actual=1';?>">Nº. Comensales</a></th>
                    <th scope="col" class="text-center"><a style="color:black; cursor:pointer; text-decoration:none;" href="<?php echo $_SERVER['PHP_SELF'].'?valor=Fecha&pagina_actual=1';?>">Fecha</a></th>
                    <th scope="col" class="text-center"><a style="color:black; cursor:pointer; text-decoration:none;" href="<?php echo $_SERVER['PHP_SELF'].'?valor=Hora&pagina_actual=1';?>">Hora</a></th>
                    <th scope="col" class="text-center"><a style="color:black; cursor:pointer; text-decoration:none;" href="<?php echo $_SERVER['PHP_SELF'].'?valor=Discapacidad&pagina_actual=1';?>">Discapacidad</a></th>
                    <th scope="col" class="text-center"><a style="color:black; cursor:pointer; text-decoration:none;" href="<?php echo $_SERVER['PHP_SELF'].'?valor=Mensaje&pagina_actual=1';?>">Mensaje</a></th>
                    <th scope="col" class="text-center"><a style="color:black; cursor:pointer; text-decoration:none;">Creado/<br>Última modificación</a></th>
                    

                    <?php 
                        //En el caso de que el trabajador tenga rol de Administrador / Jefe_Comedor daremos visibilidad/opción a los botones modificar/eliminar
                        if($_SESSION['cargo'] == "Jefe_Comedor" || $_SESSION['cargo'] == "Administrador"){
                            echo '<th scope="col" class="text-center">Modificar</th>';
                            echo '<th scope="col" class="text-center">Eliminar</th>';
                        }
                    ?>
                    
                  </tr>
                </thead>
                <tbody>
                <!--Bucle para mostrar las reservas que se encuentran en la base de datos-->
                <?php 
                    foreach($matriz_reservas as $reserva):
                ?>
                    <tr>
                      <td class="text-center" style="Display:None;"><?php echo $reserva->id?></td>
                      <td class="text-center"><?php echo $reserva->Nombre?></td>
                      <td class="text-center"><?php echo $reserva->Email?></td>
                      <td class="text-center"><?php echo $reserva->Telefono?></td>
                      <td class="text-center"><?php echo $reserva->Asistentes?></td>
                      <td class="text-center"><?php echo $reserva->Fecha?></td>
                      <td class="text-center"><?php echo $reserva->Hora?></td>
                      <td class="text-center"><?php echo $reserva->Discapacidad == 0 ? "No" : "Si";?></td>
                      <td class="text-center"><?php echo $reserva->Mensaje?></td>
                      <td class="text-center">
                            <?php
                                if($reserva->id_trabajador!=0){
                                    //Instanciamos la clase de modelo_trabajador, para obtener el email del usuario que creo/modificó el plato
                                    require_once("../Modelo/modelo_trabajadores.php");
                                    //Instanciamos la clase Reservas_modelo
                                    $trabajador = new Trabajadores_Modelo;
                                    //Obtenemos los datos del trabajador pasandole por parametro el id_trabajador, (Foreign Key)
                                    $datos_trabajador = $trabajador->seleccionarTrabajadorId($reserva->id_trabajador);
                                    echo $datos_trabajador->Email;
                                }else {
                                    echo "Cliente anónimo.";
                                }
                            ?>
                        </td>
                    
                      <?php 
                        //En el caso de que el trabajador tenga rol de Administrador / Jefe_Comedor daremos visibilidad/opción a los botones modificar/eliminar
                        if($_SESSION['cargo'] == "Jefe_Comedor" || $_SESSION['cargo'] == "Administrador"){
                            echo '<td class="text-center"><a href="../Vista/Area_Trabajadores_Reservas_Formulario.php?id='.$reserva->id .'"><img src="../../img/Iconos/icono-editar.png" class="mx-auto"></a></td>';
                            echo '<td class="text-center"><a href="../Controlador/controlador_eliminarReserva.php?id=' .$reserva->id. '"><img src="../../img/Iconos/icono-borrar.png" class="mx-auto"></a></td>';
                        }
                      ?>

                    </tr>
                    <?php
                        endforeach;
                    ?>
                </tbody>
            </table>
                <?php 
                    if($_SESSION['cargo'] == "Jefe_Comedor" || $_SESSION['cargo'] == "Administrador"){
                        echo '<a href="../Vista/Area_Trabajadores_Reservas_Formulario.php"<button class="btn btn-primary d-block w-100" id="aniadir">Añadir</button></a>';
                    }
                ?>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
        <?php
            /*Mostramos las páginas totales que tendrá la página, en caso de que el usuario ordene guardara el valor de la URL, el valor de ordenación, en caso de que no haya ordenado
            No mostrará el valor*/
            for($i=1; $i<=$paginas_totales; $i++){ 
                echo "<a class='btn btn-primary mx-2 mt-2' style='background-color: #e9bb84' href=" . $_SERVER['PHP_SELF'] . (isset($_GET['valor']) ? '?valor=' . $_GET['valor'] . '&' : '?') . "pagina_actual=$i>$i</a>";
            }
        ?>
                </div>
            </div>
        </div>
    </main>
</body>
</html>