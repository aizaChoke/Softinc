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

$sql="SELECT 
  problema.nombre_problema
FROM 
  public.problema;

";
$listaProble=  pg_query($sql);
$nombreproblema=array();
$intentos=array();
$pos=0;
while($dato= pg_fetch_array($listaProble))
{
    if(esDificl($dato['nombre_problema'])==true && $pos < 5)
    {
       $nombreproblema[]=$dato['nombre_problema'];
       $intentos[]=intento($dato['nombre_problema']);       
    }
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
  solucion_olimpista.calificacion_olimpista > 0
  
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
  $cantidad=pg_num_rows($result);
  return $cantidad;
}
?>



    
</div>

</body>
</html>