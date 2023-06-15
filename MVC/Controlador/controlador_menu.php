<?php

    //Llamamos al módulo modelo_menu
    require_once("../Modelo/modelo_menu.php");
    //Instanciamos la clase Menu_Modelo
    $platos = new Menu_Modelo;
    //Llamamos el método static de la clase paginación.
    $paginas_totales = Paginacion::getPaginasTotales("platos", 10);
    //Obtenemos todas las reservas de la base de datos.
    $matriz_platos = $platos->getPlatos();
    //Llamamos al módulo donde se visualizarán los datos.
    require_once("../Vista/Area_Trabajadores_Menu.php");

?>