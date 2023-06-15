<?php

    require_once("../Modelo/modelo_reservas.php");
    //Instanciamos la clase Reservas_modelo
    $reservas = new Reservas_Modelo;
    //Llamamos el método static de la clase paginación.
    $paginas_totales = Paginacion::getPaginasTotales("reservas", 10);
    //Obtenemos todas las reservas de la base de datos.
    $matriz_reservas = $reservas->getReservas();
    //Llamamos al módulo donde se visualizarán los datos.
    require_once("../Vista/Area_Trabajadores_Reservas.php");

?>