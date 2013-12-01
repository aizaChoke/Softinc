<body>
<?php
include 'cnx.php';
pg_connect($entrada);
$idCompetencia=$_GET['numeroCompetencia'];
$tipoDato=$_GET['idCompetencia1'];
$datos=problemaMasresuelto($idCompetencia);
$idProblema=array();
$listaProblema=array();
$cantidadProblema=array();
 
if($tipoDato=="problema")
{
echo " <h1 align='center'>Problemas que fueron resueltos en la competencia </h1> ";
  ?>
<div id="div">
  <p align="center">
<?php 

while($problema = pg_fetch_array($datos))
{
    
      if( perteneceProblemaCompetencia($idCompetencia,$problema['nombre_problema']) ==true)
      {
         // echo $problema['nombre_problema'];
         $datoProblema= cantidadProblemaCompetencia($idCompetencia,$problema['nombre_problema']);
         $idProblema[]=$datoProblema['id_problema'];
         $listaProblema[]=$datoProblema['nombre_problema'];
         $cantidadProblema[]=$datoProblema['count'];
         //echo "hola";
      }
}

arsort($cantidadProblema);
$datay = array();
$nombreProblema=array();
echo "<table border=1>";
echo "<tr><td>Id problema</td><td>nombre problema</td><td>Numero de veses resuelto </td></tr>";
foreach ($cantidadProblema as $key => $val) 
{

    echo "<tr>
          <td>".$idProblema[$key]."</td>
          <td>".$listaProblema[$key]."</td>
           <td>".$val."</td>";
    echo "</tr>";
}
echo "</table>";
?>
          </p>
    </div>
    
       <div id="div2">
          <p align="center">
          <?php  echo "  <iframe frameborder='0' scrolling ='auto'  width='360' height='250' src='../vista/estadistica/competenciaProblemaResueltoBarras.php?id=$idCompetencia' ></iframe>"; ?>
       </p>
          <p align="center">
            
          </p>
        </div>
    <div id="div3">
          <p align="center">
          <?php  echo "  <iframe frameborder='0' scrolling ='auto'  width='360' height='250' src='../vista/estadistica/competenciaTortaDelProblemaMasResuelto.php?id=$idCompetencia' ></iframe>"; ?>
       </p>
          <p align="center">
            
          </p>
        </div>   
<?php
}else if($tipoDato=="ganador")
    {
    echo " <h1 align='center'>Ranking olimpista </h1> ";
     ?>
     
<div id="div4">
  <p align="center">
<?php 
      
        $fechaCreacionCompetencia=fechaHoraCompetencia($idCompetencia);
         
        $listaOlimpista=listaCompetenciaOlimpiada($idCompetencia);
        
        $nombreOlimpista=array();
        $apellidoOlimpista=array();
        $notaOlimpista=array();
        while($nombreOlimpiCom= pg_fetch_array($listaOlimpista))
        {
           // echo "--".$nombreOlimpiCom['user_usuario']."--";
            $notaOlimpista[]=calificarOlimpistaCompetencia($nombreOlimpiCom['user_usuario'],$idCompetencia);
            $nombreOlimpista[]=$nombreOlimpiCom['nombre_usuario'];
            $apellidoOlimpista[]=$nombreOlimpiCom['apellido_usuario'];
        }
        arsort($notaOlimpista);
        $datay = array();
        $nombreProblema=array();
        echo "<table border=1>";
        echo "<tr><td>Nombre olimpista</td><td>Apellido olimpista</td><td>Puntage </td></tr>";
       foreach ($notaOlimpista as $key => $val) 
        {

        echo "<tr>
              <td>".$nombreOlimpista[$key]."</td>
              <td>".$apellidoOlimpista[$key]."</td>
              <td>".$val."</td>";
                
        echo "</tr>";
}
        echo "</table>"; 
        ?>
          </p>
    </div>
    <div id="div5">
          <p align="center">
          <?php  echo "  <iframe frameborder='0' scrolling ='auto'  width='360' height='250' src='../vista/estadistica/competenciaGanadorBarras.php?id=$idCompetencia' ></iframe>"; ?>
       </p>
          <p align="center">
            
          </p>
        </div>  
    <div id="div6">
          <p align="center">
          <?php  echo "  <iframe frameborder='0' scrolling ='auto'  width='360' height='250' src='../vista/estadistica/competenciaTortaGanador.php?id=$idCompetencia' ></iframe>"; ?>
       </p>
          <p align="center">
            
          </p>
        </div> 
    <?php
    }

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

</body>