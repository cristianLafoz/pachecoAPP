<?php

    //Creamos la clase conectar, la cual recoge los parámetros necesarios para conectarnos a la base de datos.
    class Conectar{
        
        public static function Conexion(){
            //En caso de que aparezca una excepción.
            try{
                //Variable conexion, recoge los datos para conectar a la base de datos, usaremos la libreria PDO

                $base = new PDO("mysql:host=localhost; dbname=pacheco", "root", "");

                $base->exec("SET CHARACTER SET utf8");

                return $base;
            
            } catch(Exception $e){
            
                echo "Error: ". $e->getMessage() . "<br>"; 
                echo "Línea error: " . $e->getLine();

            } finally {

                $base = null;

            }
        }
    }

?>