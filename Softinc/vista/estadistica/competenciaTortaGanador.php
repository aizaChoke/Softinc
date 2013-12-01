<?php // content="text/plain; charset=utf-8"
require_once ('jpgraph/jpgraph.php');
require_once ('jpgraph/jpgraph_pie.php');
require_once ('jpgraph/jpgraph_pie3d.php');
include '../../Modelo/cnx.php';
pg_connect($entrada);
$Promedio=array();
$nota=0;
$promedio=array();
$data=array();
$nombreProblema=array();
$idCompetencia=$_GET['id'];
 $fechaCreacionCompetencia=fechaHoraCompetencia($idCompetencia);
         
        $listaOlimpista=listaCompetenciaOlimpiada($idCompetencia);
        
        $nombreProblema=array();
        $apellidoOlimpista=array();
        $datay = array();
        while($nombreOlimpiCom= pg_fetch_array($listaOlimpista))
        {
           // echo "--".$nombreOlimpiCom['user_usuario']."--";
            $data[]=calificarOlimpistaCompetencia($nombreOlimpiCom['user_usuario'],$idCompetencia);
            $nombreProblema[]=$nombreOlimpiCom['nombre_usuario'];
            $apellidoOlimpista[]=$nombreOlimpiCom['apellido_usuario'];
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
