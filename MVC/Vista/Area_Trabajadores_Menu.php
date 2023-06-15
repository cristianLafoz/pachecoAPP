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
        if($_SESSION['cargo'] != "Administrador" && $_SESSION['cargo'] != "Cocinero" && $_SESSION['cargo'] != "Jefe_Cocina"){
            header("Location:../Vista/pagina_error.html");
        }


        $header->validar_session();

    ?>
    <main class="col-9 principal">
        <div class="container titulo">
            <h2>Gestión del Menú</h2>
        </div>
        <hr>
        <div class="container">
            <div class="container">
                <table class="table">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col" class="text-center" style="Display:None;">Id</th>
                        <th scope="col" class="text-center"><a style="color:black; cursor:pointer; text-decoration:none;" href="<?php echo $_SERVER['PHP_SELF'].'?valor=Nombre';?>">Nombre Menú</a></th>
                        <th scope="col" class="text-center"><a style="color:black; cursor:pointer; text-decoration:none;" href="<?php echo $_SERVER['PHP_SELF'].'?valor=Descripcion';?>">Descripción</a></th>
                        <th scope="col" class="text-center"><a style="color:black; cursor:pointer; text-decoration:none;" href="<?php echo $_SERVER['PHP_SELF'].'?valor=Tipo_Plato';?>">Tipo Menú</a></th>
                        <th scope="col" class="text-center">Foto</th>
                        <th scope="col" class="text-center">Creado/<br>Última modificación</th>
                        
                        <?php 
                            //Comprobamos las sesiones de los trabajadores, en caso de que sea Jefe_Cocina/Administrador, mostraremos las opciones Modificar/Eliminar
                            if($_SESSION['cargo'] == "Jefe_Cocina" || $_SESSION['cargo'] == "Administrador"){
                                echo '<th scope="col" class="text-center">Modificar</th>';
                                echo '<th scope="col" class="text-center">Borrar</th>';
                            }
                        ?>
                      </tr>
                    </thead>
                    <tbody>
                    <!--Bucle para mostrar los platos que se encuentran en la base de datos-->
                    <?php
                        foreach($matriz_platos as $plato):
                    ?>
                        <tr>
                          <td class="text-center" style="Display:None;"><?php echo $plato->id?></td>
                          <td class="text-center"><?php echo $plato->Nombre?></td>
                          <td class="text-center"><?php echo $plato->Descripcion?></td>
                          <td class="text-center"><?php echo $plato->Tipo_Plato?></td>
                          <td class="text-center"><?php echo $plato->Foto?></td>
                          <td class="text-center">
                            <?php
                                //Instanciamos la clase de modelo_trabajador, para obtener el email del usuario que creo/modificó el plato
                                require_once("../Modelo/modelo_trabajadores.php");
                                //Instanciamos la clase Reservas_modelo
                                $trabajador = new Trabajadores_Modelo;
                                //Obtenemos los datos del trabajador pasandole por parametro el id_trabajador, (Foreign Key)
                                $datos_trabajador = $trabajador->seleccionarTrabajadorId($plato->id_trabajador);
                                echo $datos_trabajador->Email;
                            ?>
                           </td>
                            <?php 
                                 //Comprobamos las sesiones de los trabajadores, en caso de que sea Jefe_Cocina/Administrador, mostraremos las opciones Modificar/Eliminar
                                if($_SESSION['cargo'] == "Jefe_Cocina" || $_SESSION['cargo'] == "Administrador"){
                                    echo '<td class="text-center"><a href="../Vista/Area_Trabajadores_Menu_Formulario.php?id='. $plato->id . '"><img src="../../img/Iconos/icono-editar.png" class="mx-auto"></a></td>';
                                    echo '<td class="text-center"><a href="../Controlador/controlador_eliminarMenu.php?id='. $plato->id .'"><img src="../../img/Iconos/icono-borrar.png" class="mx-auto"></a></td>';
                                }
                            ?>
                        </tr>
                    <?php
                        endforeach;
                    ?>  
                    </tbody>
                  </table>
                  <?php 
                    //Comprobamos las sesiones de los trabajadores, en caso de que sea Jefe_Cocina/Administrador, mostraremos las opciones Modificar/Eliminar
                    if($_SESSION['cargo'] == "Jefe_Cocina" || $_SESSION['cargo'] == "Administrador"){
                        echo '<a href="../Vista/Area_Trabajadores_Menu_Formulario.php"<button class="btn btn-primary d-block w-100" id="aniadir">Añadir</button></a>';
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
        </div>
    </main>
</body>
</html>