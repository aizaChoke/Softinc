<?php


class Equipo {

    function crearEquipo($nombre){
        include("../modelo/cnx.php");
        $cnx = pg_connect($entrada) or die ("Error de conexion. ". pg_last_error());
        $insertar= "INSERT INTO equipo(nombre_equipo)
                    VALUES ('$nombre');";
        $result = pg_query($cnx, $insertar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
    }
    function AgregarUsuarios($id, $equipo){
        include("../modelo/cnx.php");
        $cnx = pg_connect($entrada) or die ("Error de conexion. ". pg_last_error());
        $insertar= "INSERT INTO equipo_usuario(id_usuario, id_equipo)
                    VALUES ('$id', '$equipo');";
        $result = pg_query($cnx, $insertar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
    }
    function getID($nombreEquipo){
        $id=0;  
        include("../modelo/cnx.php");
        $cnx = pg_connect($entrada) or die ("Error de conexion. ". pg_last_error());
        $seleccionar=   "SELECT id_equipo, nombre_equipo
                         FROM equipo
                         where nombre_equipo='$nombreEquipo'";
        
        $result     = pg_query($seleccionar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
        $columnas   = pg_numrows($result);

        for($i=0;$i<=$columnas-1; $i++){
            $line = pg_fetch_array($result, null, PGSQL_ASSOC);
                               $id =$line['id_equipo'];                                              
        }                 
        return $id;             
    }
}

?>
