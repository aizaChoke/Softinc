<?php // content="text/plain; charset=utf-8"
require_once ('jpgraph/jpgraph.php');
require_once ('jpgraph/jpgraph_pie.php');
require_once ('jpgraph/jpgraph_pie3d.php');
include '../../Modelo/cnx.php';
pg_connect($entrada);
$Promedio=array();
$numEquipos=nunEquipo();
$nota=0;
$promedio=array();
$div=0;
$j=1;
for($i=1;$i<=$numEquipos;$i++)
{
    $listaProEquipo = listaProblemaEquipo($i);
    while($dato = pg_fetch_array($listaProEquipo))
    {
      
        $nota=$nota+mejorNota($i,$dato['id_problema']);
        $div++;
    }
    
    if($div!=0)
    {
         //echo "*".($nota/numproblemas())."*";
        $promedio[$j]=$nota/numproblemas();
   
    }else{
        
        $promedio[$j]=0;
    }
    $nota=0;
    $div=0;
    $j++;
}
arsort($promedio);
$data = array();
$nombreProblema=array();
foreach ($promedio as $key => $val) 
{
    $equipo=nombreEquipo($key);
    $data[]=$val;
    $nombreProblema[]=$equipo;
    
}
// Create the Pie Graph.
$graph = new PieGraph(440,250);
$graph->SetShadow();

// Set A title for the plot
$graph->title->Set("Porsentage ganador competencia ");
$graph->title->SetFont(FF_VERDANA,FS_BOLD,15); 
$graph->title->SetColor("darkblue");
$graph->legend->Pos(0.01,0.4);

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


function nunEquipo()
{
    $sql="SELECT 
          equipo.id_equipo
          FROM 
          public.equipo;";
    $listaEquipo=pg_query($sql);
    $res=0;
    while($dato= pg_fetch_array($listaEquipo))
    {
        $res++;
        
    }
    
    return $res;
}
function listaProblemaEquipo($idEquipo)
{
    $sql="SELECT 
  equipo.nombre_equipo, 
  solucion_olimpista.id_problema, 
  equipo_usuario.id_equipo,
  count(equipo_usuario.id_equipo)
 
FROM 
  public.equipo, 
  public.usuario, 
  public.equipo_usuario, 
  public.solucion_olimpista
WHERE 
  equipo.id_equipo = equipo_usuario.id_equipo AND
  usuario.id_usuario = equipo_usuario.id_usuario AND
  usuario.id_usuario = solucion_olimpista.id_usuario and
   equipo_usuario.id_equipo =$idEquipo
   GROUP BY 
   equipo.nombre_equipo, 
   solucion_olimpista.id_problema, 
   equipo_usuario.id_equipo
   order by solucion_olimpista.id_problema;";
    
    $listaProblemaEquipo=pg_query($sql);
    return $listaProblemaEquipo;
}

function mejorNota($idEquipo,$idProblema)
{
    $sql="SELECT 
  equipo.nombre_equipo, 
  solucion_olimpista.calificacion_olimpista, 
  problema.nombre_problema, 
  equipo.id_equipo, 
  problema.id_problema
FROM 
  public.solucion_olimpista, 
  public.usuario, 
  public.equipo, 
  public.equipo_usuario, 
  public.problema
WHERE 
  solucion_olimpista.id_usuario = usuario.id_usuario AND
  solucion_olimpista.id_usuario = equipo_usuario.id_usuario AND
  equipo.id_equipo = equipo_usuario.id_equipo AND
  problema.id_problema = solucion_olimpista.id_problema AND
  equipo.id_equipo=$idEquipo and
  problema.id_problema=$idProblema
  order by solucion_olimpista.calificacion_olimpista desc
  ;";
   $nota=pg_query($sql);
   $mejorNota=  pg_fetch_array($nota);
   return $mejorNota['calificacion_olimpista'];
    
}

function nombreEquipo($idEquipo)
{
    $sql="SELECT 
  equipo.nombre_equipo
FROM 
  public.equipo
where 
  equipo.id_equipo=$idEquipo
  ;";
   $equipo= pg_query($sql);
    $nombre= pg_fetch_array($equipo);
    return $nombre['nombre_equipo'];
}

function numproblemas()
{
    $sql="SELECT 
  count(*)
FROM 
  public.problema;";
    $cantidad=pg_query($sql);
    
    $cantidad1=  pg_fetch_array($cantidad);
  return $cantidad1['count'];   
}

?>
