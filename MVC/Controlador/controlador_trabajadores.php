<?php

     require_once("../Modelo/modelo_trabajadores.php");
     //Instanciamos la clase Reservas_modelo
     $trabajador = new Trabajadores_Modelo;
     //Llamamos el método static de la clase paginación.
     $paginas_totales = Paginacion::getPaginasTotales("trabajador", 10);
     //Obtenemos todas las reservas de la base de datos.
     $matriz_trabajadores =  $trabajador->getTrabajadores();
     //Llamamos al módulo donde se visualizarán los datos.
     require_once("../Vista/Area_Trabajadores_Trabajadores.php");

?>