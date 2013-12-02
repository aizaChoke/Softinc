<?php
 include 'cnx.php';
 pg_connect($entrada);
class presentarCompetenciaConsulta
{
    
    public function __construct() {
        $lenguages=array();
        $problemaCompetencia=array();
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


function problemaCompetencia($idCompetencia)
{
    $sql2="SELECT 
  competencia.id_competencia, 
  competencia.nombre_competencia, 
  problema.nombre_problema, 
  competencia_problema.id_competencia_problema, 
  problema.id_problema
FROM 
  public.competencia, 
  public.problema, 
  public.competencia_problema
WHERE 
  competencia_problema.id_competencia = competencia.id_competencia AND
  competencia_problema.id_problema = problema.id_problema and 
  competencia.id_competencia=$idCompetencia;

        ";
    $problema=pg_query($sql2);
    return $problema;
}
}
?>
