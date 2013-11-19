<?php // content="text/plain; charset=utf-8"
require_once ('jpgraph/jpgraph.php');
require_once ('jpgraph/jpgraph_bar.php');
include '../../Modelo/cnx.php';
pg_connect($entrada);

$sql="SELECT 
  problema.nombre_problema, 
  problema.id_problema, 
  solucion_olimpista.calificacion_olimpista,
  count(*)
FROM 
  public.problema, 
  public.solucion_olimpista
WHERE 
  problema.id_problema = solucion_olimpista.id_problema
and calificacion_olimpista=100
GROUP BY 
 problema.nombre_problema, 
  problema.id_problema, 
  solucion_olimpista.calificacion_olimpista
    order by count(*) desc;
  ;
";
$listaProble=  pg_query($sql);
$datay=array();

while($res= pg_fetch_array($listaProble))
{
    $nombreProblema[]=$res['nombre_problema'];
    $datay[]=$res['count'];
}
// Create the graph. These two calls are always required
$graph = new Graph(350,220,'auto');
$graph->SetScale("textlin");

//$theme_class="DefaultTheme";
//$graph->SetTheme(new $theme_class());

// set major and minor tick positions manually
$graph->yaxis->SetTickPositions(array(0,1,2,3,30,40,200), array(15,45,75,105,135));
$graph->SetBox(false);

//$graph->ygrid->SetColor('gray');
$graph->ygrid->SetFill(false);
$graph->xaxis->SetTickLabels($nombreProblema)  ;
$graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false,false);

// Create the bar plots
$b1plot = new BarPlot($datay);

// ...and add it to the graPH
$graph->Add($b1plot);


$b1plot->SetColor("white");
$b1plot->SetFillGradient("#4B0082","white",GRAD_LEFT_REFLECTION);
$b1plot->SetWidth(45);
$graph->title->Set("Ranking de problemas");
$graph->title->SetFont(FF_VERDANA,FS_BOLD,15);
$graph->title->SetColor("darkblue");
// Display the graph
$graph->Stroke();
 
?>