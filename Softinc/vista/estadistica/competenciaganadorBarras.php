<?php // content="text/plain; charset=utf-8"
require_once ('jpgraph/jpgraph.php');
require_once ('jpgraph/jpgraph_bar.php');
require_once ('jpgraph/jpgraph.php');
require_once ('jpgraph/jpgraph_bar.php');
include '../../Modelo/cnx.php';
pg_connect($entrada);
$idCompetencia=$_GET['id'];

//$datay = array();


 $fechaCreacionCompetencia=fechaHoraCompetencia($idCompetencia);
         
        $listaOlimpista=listaCompetenciaOlimpiada($idCompetencia);
        
        $nombreProblema=array();
        $apellidoOlimpista=array();
        $datay = array();
        while($nombreOlimpiCom= pg_fetch_array($listaOlimpista))
        {
           // echo "--".$nombreOlimpiCom['user_usuario']."--";
            $datay[]=calificarOlimpistaCompetencia($nombreOlimpiCom['user_usuario'],$idCompetencia);
            $nombreProblema[]=$nombreOlimpiCom['nombre_usuario'];
            $apellidoOlimpista[]=$nombreOlimpiCom['apellido_usuario'];
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

function listaProblemaCompetencia($idCompetencia)
 {
     $sql="SELECT 
  problema.nombre_problema, 
  competencia.id_competencia
FROM 
  public.competencia, 
  public.competencia_problema, 
  public.problema
WHERE 
  competencia_problema.id_competencia = competencia.id_competencia AND
  problema.id_problema = competencia_problema.id_problema and 
  competencia.id_competencia=$idCompetencia;
";
     $res=  pg_query($sql);
     return $res;
 }
 
 function listaCompetenciaOlimpiada($idCompetencia)
 {
     $sql="SELECT 
  competencia.id_competencia, 
  competencia.nombre_competencia, 
  usuario.nombre_usuario, 
  usuario.apellido_usuario, 
  usuario.user_usuario
FROM 
  public.competencia, 
  public.competencia_usuario, 
  public.usuario
WHERE 
  competencia.id_competencia = competencia_usuario.id_competencia AND
  usuario.id_usuario = competencia_usuario.id_usuario and
 competencia.id_competencia=$idCompetencia
  ;";
     $res=  pg_query($sql);
     return $res;
 }
 
 function calificarOlimpistaCompetencia($usuarioOlimpista ,$idCompetencia )
 { 
      $ListaProblema= listaProblemaCompetencia($idCompetencia); 
     $nota=0;
     $total=0;
     while($dato= pg_fetch_array($ListaProblema))
     {

       //  echo "*".$dato['nombre_problema']." -- ".$usuarioOlimpista."*";
         $nota=$nota+notaProblema($idCompetencia,$dato['nombre_problema'] ,$usuarioOlimpista);
         $total++;
     }
         
     return $nota/$total;
 }
 
 
 function notaProblema($idCompetencia, $nombreProblema ,$user)
 {
  //  echo "??";
     $sql="SELECT 
  solucion_olimpista.calificacion_olimpista
FROM 
  public.usuario, 
  public.solucion_olimpista, 
  public.problema, 
  public.competencia, 
  public.competencia_problema
WHERE 
  usuario.id_usuario = solucion_olimpista.id_usuario AND
  problema.id_problema = solucion_olimpista.id_problema AND
  problema.id_problema = competencia_problema.id_problema AND
  competencia.id_competencia = competencia_problema.id_competencia and
  solucion_olimpista.id_competencia_olimpista=$idCompetencia and 
  competencia.id_competencia=$idCompetencia and
  problema.nombre_problema='$nombreProblema' and
  usuario.user_usuario='$user'
  order by  solucion_olimpista.calificacion_olimpista desc
  ;
";
     
     $res=  pg_query($sql);
     $res1 =  pg_fetch_array($res);
     return $res1['calificacion_olimpista'];
 }
 function numProblemas($idCompetencia)
 {
     $sql="SELECT 
  problema.nombre_problema, 
  competencia.id_competencia
FROM 
  public.competencia, 
  public.competencia_problema, 
  public.problema
WHERE 
  competencia_problema.id_competencia = competencia.id_competencia AND
  problema.id_problema = competencia_problema.id_problema and 
  competencia.id_competencia=$idCompetencia;
";
     $res=  pg_query($sql);
     $total=0;
     while($dato= pg_fetch_array($res))
     {
         $total++;
     }
     return $total;
 }
?>