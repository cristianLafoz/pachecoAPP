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
            <div class="col-2">
                <nav class="navbar navegacion">
                    <ul class="nav navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="../Controlador/controlador_menu.php"> Volver </a>
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

        //Comprobamos si existe un ID en la URL en caso de que exista, el usuario querrá MODIFICAR un plato, recogemos los datos de la URL y los colocamos en el formulario
        if(isset($_GET['id'])){
            $id = $_GET['id'];

            //Llamamos al modulo modelo_menu
            require_once("../Modelo/modelo_menu.php");
            $plato = new Menu_Modelo;
            //Llamamos al método seleccionarPlatoId que recoge los datos de la base de datos según el ID
            $plato_actual = $plato->seleccionarPlatoId($id);

            //Guardamos en las variables los datos de la base de datos
            $Nombre =  $plato_actual->Nombre;
            $Descripcion =  $plato_actual->Descripcion;
            $Tipo_Plato =  $plato_actual->Tipo_Plato;
            $Foto =  $plato_actual->Foto;
        

        } else {    

            //En caso de que no haya un ID en la URL, el usuario querrá AÑADIR un plato nuevo, por lo que las variables estaran vacías.
            $Nombre =  "";
            $Descripcion =  "";
            $Tipo_Plato =  "";
            $Foto =  "";
        }

?>
    <main class="col-9 principal">
        <div class="container titulo">
            <h2>Formulario Menú</h2>
        </div>
        <hr>
        <div class="d-flex justify-content-center align-items-center">
            <form class="bg-light p-5 mt-5 border border-dark" method="post" action="../Controlador/controlador_menu_formulario.php" id="formulario-plato" enctype="multipart/form-data">
                <h2 class="mb-4">Formulario de Menú</h2>
                <div class="mb-3">
                    <label for="Nombre" class="form-label">Nombre Menú</label>
                    <input type="text" class="form-control" id="Nombre" name="nombre" placeholder="Nombre" value="<?php echo $Nombre;?>">
                </div>
                <div class="mb-3">
                    <label for="Descripcion" class="form-label">Descripción Palto</label><br>
                    <textarea id="Descripcion" class="form-control rows-4" name="descripcion" style="width:100%; height:auto;" maxlength="100"><?php echo $Descripcion?></textarea>
                </div>
                <div class="mb-3">
                    <label for="Tipo_Menu" class="form-label">Tipo Menú</label>
                    <select class="form-control" id="Tipo_Menu" name="Tipo_Plato">
                        <option disabled selected>-Seleccione Tipo Menú-</option>
                        <option value="Entrantes" <?php if($Tipo_Plato=="Entrantes") echo "selected"?>>Entrante</option>
                        <option value="Primero" <?php if($Tipo_Plato=="Primero") echo "selected"?>>Primero</option>
                        <option value="Segundo" <?php if($Tipo_Plato=="Segundo") echo "selected"?>>Segundo</option>
                        <option value="Postre" <?php if($Tipo_Plato=="Postre") echo "selected"?>>Postre</option>
                        <option value="Bebidas" <?php if($Tipo_Plato=="Bebidas") echo "selected"?>>Bebidas</option>
                      </select>
                </div>
                <div class="mb-3">
                    <label for="Imagen" class="form-label">Imagen Menú:</label>
                    <br>
                    <input type="file" accept="image/png, .jpeg, .jpg" class="form-control" id="Imagen" name="imagen">
                </div>
                <!-- Añadimos campo hidden para conseguir el ID, el cual se pasará al modelo.-->
                <input type="hidden" name="id" value="<?php echo isset($_GET['id'])? $id : "";?>">
                <!-- Añadimos campo hidden que pasara un valor segun sea para añadir o modificar-->
                <input type="hidden" name="accion" value="<?php echo isset($_GET['id']) ? 'modificar' : 'anadir'; ?>">
                <button class="btn btn-primary d-block w-100" id="aniadir"type="submit" style="background: rgb(217,144,54);"> <?php echo isset($_GET['id']) ? 'Modificar' : 'Añadir'; ?> </button>
            </form>
        </div>
    </main>
    <script type="module" src="./js/formulario_menu.js"></script>
</body>
</html>