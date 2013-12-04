<html>
<head>
	<title></title>
</head>
<body>
<h1 align="center">Ranking de los problemas mas complicados</h1>
<div align="center">
  <?php
include '../Modelo/cnx.php';
pg_connect($entrada);

$problemaMasDificiles=problemaMasdificiles();


$listaProble=MaFaciles($problemaMasDificiles);

$nombreproblema=array();
$intentos=array();
$pos=0;
for($i=0;$i<sizeof($listaProble);$i++)
{

       $nombreproblema[]=$listaProble[$i];
       $intentos[]=intento($listaProble[$i]);       
    
    $pos++;
}
arsort($intentos);

echo" <table border=1> 
<tr><td>Posicion</td><td>Nombre Problema</td><td>Numero problemas hechos</td></tr>    
";
$i=0;
foreach ($intentos as $key => $val) 
    {
        
       echo "<tr>";
        echo "<td>$i</td>";
        echo "<td>$nombreproblema[$key]</td>";
        echo "<td>$val</td>";
       echo "</tr>";
//echo "*$key = $val*\n";
    $i++;
    
    }
echo "</table>";

function MaFaciles($problemaMasDificiles)
{
    $sql="SELECT 
  problema.id_problema, 
  problema.nombre_problema, 
  solucion_olimpista.tipo_solucion, 
  solucion_olimpista.id_competencia_olimpista,
  count(*)
  
FROM 
  public.problema, 
  public.solucion_olimpista
WHERE 
  problema.id_problema = solucion_olimpista.id_problema and
  solucion_olimpista.tipo_solucion='entrenamiento' and 
  solucion_olimpista.id_competencia_olimpista=0
GROUP BY 
  problema.id_problema, 
  problema.nombre_problema, 
  solucion_olimpista.tipo_solucion, 
  solucion_olimpista.id_competencia_olimpista
;
";
    $problemas=pg_query($sql);
    $lista=array();
    while($dato=  pg_fetch_array($problemas))
    {
     if(Esdificil($dato['nombre_problema'])==0)
        {
        $lista[]=$dato['nombre_problema'];
        
         }
    }
    return $lista;
}

function Esdificil($nombreProblema)
{
    $sql="SELECT 
  problema.id_problema, 
  problema.nombre_problema, 
  solucion_olimpista.calificacion_olimpista, 
  solucion_olimpista.tipo_solucion, 
  solucion_olimpista.id_competencia_olimpista
FROM 
  public.solucion_olimpista, 
  public.problema
WHERE 
  problema.id_problema = solucion_olimpista.id_problema AND
  solucion_olimpista.calificacion_olimpista=100 and
  solucion_olimpista.tipo_solucion='entrenamiento' AND
  solucion_olimpista.id_competencia_olimpista=0 and
  problema.nombre_problema='$nombreProblema';
";
  $lista=  pg_query($sql);
  $cantidad=  pg_num_rows($lista);
  return $cantidad;
}

function problemaMasdificiles()
{
    $sql="SELECT 
  problema.id_problema, 
  problema.nombre_problema, 
  solucion_olimpista.calificacion_olimpista, 
  solucion_olimpista.tipo_solucion, 
  solucion_olimpista.id_competencia_olimpista
FROM 
  public.solucion_olimpista, 
  public.problema
WHERE 
  problema.id_problema = solucion_olimpista.id_problema AND
  solucion_olimpista.calificacion_olimpista=100 and
  solucion_olimpista.tipo_solucion='entrenamiento' AND
  solucion_olimpista.id_competencia_olimpista=0;
";
    $res=  pg_query($sql);
    return $res;
    
}
function esDificl($nombreproblema)
{
  $sql="
SELECT 
  problema.nombre_problema, 
  problema.id_problema, 
  solucion_olimpista.calificacion_olimpista,
  count(*)
FROM 
  public.problema, 
  public.solucion_olimpista
WHERE 
  problema.id_problema = solucion_olimpista.id_problema and
  solucion_olimpista.tipo_solucion='entrenamiento' and
  problema.nombre_problema = '$nombreproblema' and
  solucion_olimpista.calificacion_olimpista < 100 
  
GROUP BY 
 problema.nombre_problema, 
  problema.id_problema, 
  solucion_olimpista.calificacion_olimpista
  order by count(*) desc;
  ;
   ";  
  $result=  pg_query($sql);
  $cantidad=pg_num_rows($result);
  $res=false;
  
  if($cantidad==0)
  {
      $res=true;
  }else{
      $res=false;
  }
  return $res;
}

function intento($nombreProblema)
{
    $sql="
SELECT 
  problema.nombre_problema, 
  problema.id_problema, 
  solucion_olimpista.calificacion_olimpista,
  count(*)
FROM 
  public.problema, 
  public.solucion_olimpista
WHERE 
  problema.id_problema = solucion_olimpista.id_problema and
  solucion_olimpista.tipo_solucion='entrenamiento' and
  problema.nombre_problema = '$nombreProblema' and
  solucion_olimpista.calificacion_olimpista = 0
  
GROUP BY 
 problema.nombre_problema, 
  problema.id_problema, 
  solucion_olimpista.calificacion_olimpista
  order by count(*) desc;
   ";
  $result=  pg_query($sql);
  $res=  pg_fetch_array($result);
  return $res['count'];
}
?>



    
</div>

</body>
</html>