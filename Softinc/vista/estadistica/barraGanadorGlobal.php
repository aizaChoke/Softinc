<?php // content="text/plain; charset=utf-8"
require_once ('jpgraph/jpgraph.php');
require_once ('jpgraph/jpgraph_bar.php');
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







// Create the graph. These two calls are always required
$graph = new Graph(350,220,'auto');
$graph->SetScale("textlin");

//$theme_class="DefaultTheme";
//$graph->SetTheme(new $theme_class());

// set major and minor tick positions manually
$graph->yaxis->SetTickPositions(array(0,30,60,90,120,150), array(15,45,75,105,135));
$graph->SetBox(false);

//$graph->ygrid->SetColor('gray');
$graph->ygrid->SetFill(false);
$graph->xaxis->SetTickLabels( $equipo);
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