<?php
 include 'cnx.php';
 pg_connect($entrada);
class presentarCompetenciaConsulta
{
    
    public function __construct() {
        $lenguages=array();
    }
    
    function lenguages($idCompetencia)
    {
        $sql="SELECT 
  competencia_lenguaje.id_competencia, 
  lenguaje.nombre_lenguaje
FROM 
  public.competencia, 
  public.lenguaje, 
  public.competencia_lenguaje
WHERE 
  competencia.id_competencia = competencia_lenguaje.id_competencia AND
  lenguaje.id_lenguaje_competencia = competencia_lenguaje.id_lenguaje_competencia and
  competencia_lenguaje.id_competencia=$idCompetencia;";
        $lenguaguages=pg_query($sql);
        return $lenguaguages; 
    }
}

/*
$dato= new presentarCompetenciaConsulta();
$mensaje=$dato->lenguages(1);

while($res=  pg_fetch_array($mensaje))
{
    
    echo $res['nombre_lenguaje'];
}
{
    
}
*/
?>
