<?php
    require_once("../Modelo/modelo_consultas.php");
    //Instanciamos la clase Consultas_Modelo
    $consultas = new Consultas_Modelo;
    //Llamamos el método static de la clase paginación.
    $paginas_totales = Paginacion::getPaginasTotales("consultas", 10);
    //Obtenemos todas las reservas de la base de datos.
    $consultas_listado = $consultas->getConsultas();
    //Llamamos al módulo donde se visualizarán los datos.
    require_once("../Vista/Area_Trabajadores_Consultas.php");

?>