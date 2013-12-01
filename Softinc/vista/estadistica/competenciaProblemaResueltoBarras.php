<?php // content="text/plain; charset=utf-8"
require_once ('jpgraph/jpgraph.php');
require_once ('jpgraph/jpgraph_bar.php');
require_once ('jpgraph/jpgraph.php');
require_once ('jpgraph/jpgraph_bar.php');
include '../../Modelo/cnx.php';
pg_connect($entrada);
$idCompetencia=$_GET['id'];

$datos=problemaMasresuelto($idCompetencia);
$idProblema=array();
$listaProblema=array();
$cantidadProblema=array();
$datay = array();
$nombreProblema=array();
while($problema = pg_fetch_array($datos))
{
    
      if( perteneceProblemaCompetencia($idCompetencia,$problema['nombre_problema']) ==true)
      {
         // echo $problema['nombre_problema'];
         $datoProblema= cantidadProblemaCompetencia($idCompetencia,$problema['nombre_problema']);
         $idProblema[]=$datoProblema['id_problema'];
         $nombreProblema[]=$datoProblema['nombre_problema'];
         $datay[]=$datoProblema['count'];
         //echo "hola";
      }
}



// Create the graph. These two calls are always required
$graph = new Graph(360,250,'auto');
$graph->SetScale("textlin");

//$theme_class="DefaultTheme";
//$graph->SetTheme(new $theme_class());

// set major and minor tick positions manually
$graph->yaxis->SetTickPositions($datay, array(15,45,75,105,135,145,155,156));
$graph->SetBox(false);

//$graph->ygrid->SetColor('gray');
$graph->ygrid->SetFill(false);
$graph->xaxis->SetTickLabels($nombreProblema);
$graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false,false);

// Create the bar plots
$b1plot = new BarPlot($datay);

// ...and add it to the graPH
$graph->Add($b1plot);


$b1plot->SetColor("white");
$b1plot->SetFillGradient("#4B0082","white",GRAD_LEFT_REFLECTION);
$b1plot->SetWidth(45);
$graph->title->Set("Bar Gradient(Left reflection)");

// Display the graph
$graph->Stroke();

function problemaMasresuelto($idCompetencia)
{
    $sql="
SELECT 
   problema.nombre_problema, 
  competencia.id_competencia, 
  competencia.nombre_competencia, 
  problema.id_problema, 
  competencia.fecha_inicio_competencia, 
  competencia.fecha_fin_competencia, 
  solucion_olimpista.tipo_solucion,
  count(*)
FROM 
  public.problema, 
  public.competencia, 
  public.competencia_problema, 
  public.solucion_olimpista
WHERE 
  problema.id_problema = competencia_problema.id_problema AND
  competencia.id_competencia = competencia_problema.id_competencia AND
  solucion_olimpista.id_problema = problema.id_problema and
  solucion_olimpista.tipo_solucion='competencia' and
  competencia.id_competencia=$idCompetencia and
  solucion_olimpista.calificacion_olimpista=100 and
  solucion_olimpista.id_competencia_olimpista=$idCompetencia
GROUP BY 
  problema.nombre_problema, 
  competencia.id_competencia, 
  competencia.nombre_competencia, 
  problema.id_problema, 
  competencia.fecha_inicio_competencia, 
  competencia.fecha_fin_competencia, 
  solucion_olimpista.tipo_solucion    
    ;
";
    $res=  pg_query($sql);
    return $res;
}


function perteneceProblemaCompetencia($idCompetencia,$nombreproblema)
{
    
 $fechaHoraCreacionCompetencia=fechaHoraCompetencia($idCompetencia);
 
 $fechaIni= $fechaHoraCreacionCompetencia['fecha_inicio_competencia'];
 $fechaIni1=explode(" ",$fechaIni);
 $horaIni=explode("-",$fechaIni1[1]);
 
 $fechaFin= $fechaHoraCreacionCompetencia['fecha_fin_competencia'];
 $fecheFin1=explode(" ",$fechaFin);
 $horaFin=explode("-",$fecheFin1[1]);
 // echo "$fechaIni1[0]<br>";
 // echo "$fecheFin1[0]<br>";
 //echo "$horaIni[0]<br>";
 //echo "$horaFin[0]<br>";
 $sql="SELECT 
  problema.id_problema, 
  problema.nombre_problema, 
  solucion_olimpista.fecha_subida, 
  solucion_olimpista.hora_subida
FROM 
  public.solucion_olimpista, 
  public.problema
WHERE 
  problema.id_problema = solucion_olimpista.id_problema  and
  solucion_olimpista.fecha_subida between '$fechaIni1[0]' and '$fecheFin1[0]' 
 and solucion_olimpista.id_competencia_olimpista=$idCompetencia and
   problema.nombre_problema='$nombreproblema'
  ; ";
 $res=pg_query($sql);
 $bandera=false;
 while($date = pg_fetch_array($res))
 {
     if($date['nombre_problema']==$nombreproblema)
     {
         $bandera=true;
     }
 }
return $bandera;
}


function cantidadProblemaCompetencia($idComptencia,$nombreProblema)
{
 $fechaHoraCreacionCompetencia=fechaHoraCompetencia($idComptencia);
 
 $fechaIni= $fechaHoraCreacionCompetencia['fecha_inicio_competencia'];
 $fechaIni1=explode(" ",$fechaIni);
 $horaIni=explode("-",$fechaIni1[1]);
 
 $fechaFin= $fechaHoraCreacionCompetencia['fecha_fin_competencia'];
 $fecheFin1=explode(" ",$fechaFin);
 $horaFin=explode("-",$fecheFin1[1]);
    $sql="        
SELECT 
  problema.id_problema, 
  problema.nombre_problema,
  solucion_olimpista.calificacion_olimpista,
  count(*)
FROM 
  public.solucion_olimpista, 
  public.problema
WHERE 
  problema.id_problema = solucion_olimpista.id_problema  and
  solucion_olimpista.fecha_subida between '$fechaIni1[0]' and '$fecheFin1[0]' and   
  solucion_olimpista.id_competencia_olimpista=$idComptencia and
   problema.nombre_problema='$nombreProblema'and
  solucion_olimpista.calificacion_olimpista=100
GROUP BY
 problema.id_problema, 
 problema.nombre_problema,
 solucion_olimpista.calificacion_olimpista
  ;";   
    
    $res= pg_query($sql);
    $datoRes=  pg_fetch_array($res);
    return $datoRes;
}
function fechaHoraCompetencia($idComptencia)
{
    $sql="
SELECT 
  competencia.id_competencia, 
  competencia.fecha_inicio_competencia, 
  competencia.fecha_fin_competencia
FROM 
  public.competencia
where 
  competencia.id_competencia=$idComptencia
  ;";
    
    $res=pg_fetch_array(pg_query($sql));
    return $res;
    
}
?>

?>