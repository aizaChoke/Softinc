<?php // content="text/plain; charset=utf-8"
require_once ('jpgraph/jpgraph.php');
require_once ('jpgraph/jpgraph_pie.php');
require_once ('jpgraph/jpgraph_pie3d.php');
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
 and
 solucion_olimpista.tipo_solucion='entrenamiento'
GROUP BY 
 problema.nombre_problema, 
  problema.id_problema, 
  solucion_olimpista.calificacion_olimpista
    order by count(*) desc;
  ;
";
$listaProble=  pg_query($sql);

// Some data
$data = array();
$nombreProblema=array();
while($res= pg_fetch_array($listaProble))
{
$data[]=$res['count'];
$nombreProblema[]=$res['nombre_problema'];
}
// Create the Pie Graph.
$graph = new PieGraph(350,200);
$graph->SetShadow();

// Set A title for the plot
$graph->title->Set("Porsentaje de Ranking");
$graph->title->SetFont(FF_VERDANA,FS_BOLD,15); 
$graph->title->SetColor("darkblue");
$graph->legend->Pos(0.1,0.5);

// Create 3D pie plot
$p1 = new PiePlot3d($data);
$p1->SetTheme("sand");
$p1->SetCenter(0.4);
$p1->SetSize(80);

// Adjust projection angle
$p1->SetAngle(45);

// As a shortcut you can easily explode one numbered slice with
$p1->ExplodeSlice(3);

// Setup the slice values
$p1->value->SetFont(FF_ARIAL,FS_BOLD,11);
$p1->value->SetColor("navy");

$p1->SetLegends($nombreProblema);

$graph->Add($p1);
$graph->Stroke();

?>

