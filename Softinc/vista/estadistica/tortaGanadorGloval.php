<?php // content="text/plain; charset=utf-8"
require_once ('jpgraph/jpgraph.php');
require_once ('jpgraph/jpgraph_pie.php');
require_once ('jpgraph/jpgraph_pie3d.php');
include '../../Modelo/cnx.php';
pg_connect($entrada);

$nota=0;
$idOlimpista=array();
$promedio=array();
$nombre=array();
$apellido=array();
$div=0;
$j=1;
$datay=array();
$equipo=array();
$listaProOlimpista = listaOlimpista();
    
    while($dato = pg_fetch_array($listaProOlimpista))
    {
        $idOlimpista=$dato['id_usuario'];
        $datay[]=mejorNota($dato['id_usuario'],listaProblema());
        $equipo[]=$dato['nombre_usuario'];       
        $apellido[]=$dato['apellido_usuario'];
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
$p1 = new PiePlot3d($datay);
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

$p1->SetLegends($equipo);

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
   equipo_usuario.id_equipo = $idEquipo and
   solucion_olimpista.tipo_solucion='entrenamiento' 
   GROUP BY 
   equipo.nombre_equipo, 
   solucion_olimpista.id_problema, 
   equipo_usuario.id_equipo
   order by solucion_olimpista.id_problema;";
    
    $listaProblemaEquipo=pg_query($sql);
    return $listaProblemaEquipo;
}

function mejorNota($idOlimpista,$listaProblema)
{
    $notaProblema=0;
    while($dato=  pg_fetch_array($listaProblema))
    {
       
        $notaProblema= $notaProblema+notaporProblema($idOlimpista,$dato['nombre_problema']);
   
       }
      
    return $notaProblema;
}

function notaporProblema($idOlimpista,$nombreProblema)
{
    $sql="SELECT 
  usuario.nombre_usuario, 
  usuario.apellido_usuario, 
  usuario.user_usuario, 
  usuario.id_usuario, 
  solucion_olimpista.calificacion_olimpista, 
  problema.nombre_problema, 
  solucion_olimpista.tipo_solucion
FROM 
  public.usuario, 
  public.solucion_olimpista, 
  public.problema
WHERE 
  usuario.id_usuario = solucion_olimpista.id_usuario AND
  problema.id_problema = solucion_olimpista.id_problema and
  solucion_olimpista.tipo_solucion='entrenamiento' and  
  problema.nombre_problema='$nombreProblema' and 
  usuario.id_usuario=$idOlimpista  
  ORDER BY solucion_olimpista.calificacion_olimpista  DESC
  ;";
   $res1=  pg_query($sql);
    
   $res=  pg_fetch_array($res1);
   return $res['calificacion_olimpista'];
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

function listaProblema()
{
    $sql="SELECT 
  problema.nombre_problema
FROM 
  public.problema;
";
   $res= pg_query($sql);
    return $res;
}

function listaOlimpista()
{
    $sql="SELECT 
  usuario.nombre_usuario, 
  usuario.apellido_usuario, 
  usuario.user_usuario, 
  rol.nombre_tipo, 
  usuario.id_usuario
FROM 
  public.usuario, 
  public.rol, 
  public.usuario_rol
WHERE 
  usuario_rol.id_rol = rol.id_rol AND
  usuario_rol.id_usuario = usuario.id_usuario and
 rol.nombre_tipo='olimpista'
  ;

";
    $res=  pg_query($sql);
    return $res;
}
?>
