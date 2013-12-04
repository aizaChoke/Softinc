<?php
include 'cnx.php';
pg_connect($entrada);
class verificarEquipoExiste
{
    public function __construct() {
        $existe=array();
    }
    
    function existe($nombre)
    {
        $sql="SELECT 
  equipo.nombre_equipo
FROM 
  public.equipo
where
equipo.nombre_equipo='$nombre'
; ";
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
