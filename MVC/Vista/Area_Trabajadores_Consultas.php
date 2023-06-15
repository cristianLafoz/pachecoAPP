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
        if($_SESSION['cargo'] != "Administrador"){
            header("Location:../Vista/pagina_error.html");
        }

        $header->validar_session();

    ?>

    <main class="col-9 principal">
        <div class="container titulo">
            <h2>Administración de las consultas</h2>
        </div>
        <hr>
        <div class="container">
            <table class="table">
                <thead class="thead-dark" style="table-layout: auto;">
                  <tr>
                    <th scope="col" class="text-center" style="Display:None;">Id</th>
                    <th scope="col" class="text-center"><a style="color:black; cursor:pointer; text-decoration:none;" href="<?php echo $_SERVER['PHP_SELF'].'?valor=Nombre';?>">Nombre</a></th>
                    <th scope="col" class="text-center"><a style="color:black; cursor:pointer; text-decoration:none;" href="<?php echo $_SERVER['PHP_SELF'].'?valor=Email';?>">Email</a></th>
                    <th scope="col" class="text-center"><a style="color:black; cursor:pointer; text-decoration:none;" href="<?php echo $_SERVER['PHP_SELF'].'?valor=Telefono';?>">Teléfono</a></th>
                    <th scope="col" class="text-center"><a style="color:black; cursor:pointer; text-decoration:none;" href="<?php echo $_SERVER['PHP_SELF'].'?valor=Titulo_Consulta';?>">Titulo Consulta</a></th>
                    <th scope="col" class="text-center"><a style="color:black; cursor:pointer; text-decoration:none;" href="<?php echo $_SERVER['PHP_SELF'].'?valor=Consulta';?>">Consulta</a></th>
                    <th scope="col" class="text-center">Responder Consulta</th>
                    <th scope="col" class="text-center">Eliminar</th>
                  </tr>
                </thead>
                <tbody>
                <!--Bucle para mostrar las consultas que se encuentran en la base de datos-->
                <?php 
                    foreach( $consultas_listado as $consulta):
                ?>
                    <tr>
                      <td class="text-center" style="Display:None;"><?php echo $consulta->id?></td>
                      <td class="text-center"><?php echo $consulta->Nombre?></td>
                      <td class="text-center"><?php echo $consulta->Email?></td>
                      <td class="text-center"><?php echo $consulta->Telefono?></td>
                      <td class="text-center"><?php echo $consulta->Titulo_Consulta?></td>
                      <td class="text-center" style="height: auto;"><?php echo $consulta->Consulta?></td>
                      <td class="text-center"><a href="mailto:<?php echo $consulta->Email?>?subject=<?php echo $consulta->Titulo_Consulta?>&body=<?php echo $consulta->Consulta ?>"><button class="btn btn-primary d-block w-100" >Responder</button></a></td>
                      <td class="text-center"><a href="../Controlador/controlador_eliminarConsulta.php?id=<?php echo $consulta->id ?>"><img src="../../img/Iconos/icono-borrar.png" class="mx-auto"></a></td>
                    </tr>
                <?php   
                    endforeach;
                ?>

                </tbody>
              </table>
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