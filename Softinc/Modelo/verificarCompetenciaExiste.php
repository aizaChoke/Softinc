<?php
include 'cnx.php';
pg_connect($entrada);
class verificarCompetenciaExiste
{
    public function __construct() {
        $existe=array();
    }
    
    function existe($nombre)
    {
        $sql="SELECT 
  competencia.id_competencia, 
  competencia.nombre_competencia
FROM 
  public.competencia
where
 competencia.nombre_competencia='$nombre'
;   
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
