<?php
include 'cnx.php';
pg_connect($entrada);
class verificarProblemaExiste
{
    public function __construct() {
        $existe=array();
    }
    
    function existe($nombre)
    {
        $sql="SELECT 
          problema.id_problema, 
          problema.nombre_problema
          FROM 
          public.problema
          where  
          problema.nombre_problema='$nombre';   
       ";
        $res=pg_query($sql);
        $num = pg_num_rows($res);
        $bandera=true;
        if($num==0)
        {
            $bandera=true;
        }else{
            $bandera=false;
            
        }
        return $bandera;
    }
}
?>
