<?php

require_once 'cabecera.php';


$nombreRol = $_GET["nombre_rol"];
if( strcmp($nombreRol,"olimpista") == 0 )
{
    require_once 'olimpistaIndex.php';
}
else{
    if(strcmp($nombreRol,"comite") == 0 )
    {require_once 'pie.php';
         require_once 'comiteIndex.php';
    }
    else{
        require_once 'administradorIndex.php';
    }
}

require_once 'pie.php';

?>