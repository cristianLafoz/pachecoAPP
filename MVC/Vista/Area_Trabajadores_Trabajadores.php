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
            <h2>Administración de los trabajadores</h2>
        </div>
        <hr>
        <div class="container">
            <table class="table">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col" class="text-center" style="Display:None;">Id</th>
                    <th scope="col" class="text-center"><a style="color:black; cursor:pointer; text-decoration:none;" href="<?php echo $_SERVER['PHP_SELF'].'?valor=Nombre';?>">Nombre</a></th>
                    <th scope="col" class="text-center"><a style="color:black; cursor:pointer; text-decoration:none;" href="<?php echo $_SERVER['PHP_SELF'].'?valor=Primer_Apellido';?>">Primer Apellido</a></th>
                    <th scope="col" class="text-center"><a style="color:black; cursor:pointer; text-decoration:none;" href="<?php echo $_SERVER['PHP_SELF'].'?valor=Segundo_Apellido';?>">Segundo Apellido</a></th>
                    <th scope="col" class="text-center"><a style="color:black; cursor:pointer; text-decoration:none;" href="<?php echo $_SERVER['PHP_SELF'].'?valor=Email';?>">Email</a></th>
                    <th scope="col" class="text-center"><a style="color:black; cursor:pointer; text-decoration:none;" href="<?php echo $_SERVER['PHP_SELF'].'?valor=Tipo_Cargo';?>">Cargo</a></th>              
                    <th scope="col" class="text-center">Modificar</th>
                    <th scope="col" class="text-center">Borrar</th>
                  </tr>
                </thead>
                <tbody>
                <!--Bucle para mostrar los trabajdores que se encuentran en la base de datos-->
                <?php 
                    foreach($matriz_trabajadores as $trabajador):
                ?>
                    <tr>
                        <td class="text-center" style="Display:None;"><?php echo $trabajador->id?></td>
                        <td class="text-center"><?php echo $trabajador->Nombre?></td>
                        <td class="text-center"><?php echo $trabajador->Primer_Apellido?></td>
                        <td class="text-center"><?php echo $trabajador->Segundo_Apellido?></td>
                        <td class="text-center"><?php echo $trabajador->Email?></td>
                        <td class="text-center"><?php echo $trabajador->Tipo_Cargo?></td>
                <?php
                    //Si la sesión es diferente al id del trabajador que se encuentra actualmente trabajando, puede modificar al resto de trabajadores siempre que tenga el rol adecuado
                    //El "Trabajador" con id=51 se trata del cliente anónimo el cual no se puede modificar.
                    if($trabajador->Tipo_Cargo != "Administrador" && $trabajador->id != 51){
                        echo '<td class="text-center"><a href="../Vista/Area_Trabajadores_Trabajadores_Formulario.php?id='. $trabajador->id .'"><img src="../../img/Iconos/icono-editar.png" class="mx-auto"></a></td>';
                        echo '<td class="text-center"><a href="../Controlador/controlador_eliminarTrabajador.php?id=' . $trabajador->id .'"><img src="../../img/Iconos/icono-borrar.png" class="mx-auto"></a></td>';
                    }
                ?>
                        </tr>
                <?php   
                    endforeach;
                ?>

                </tbody>
            </table>
              <a href="../Vista/Area_Trabajadores_Trabajadores_Formulario.php"<button class="btn btn-primary d-block w-100" id="aniadir">Añadir</button></a>
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