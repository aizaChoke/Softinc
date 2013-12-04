<html>
<head>
	<title></title>
</head>
<body>
<h1 align="center">Ranking de los problemas <br> mas veces resueltos, que obtuvieron 100  </h1>
<div align="center">
  <?php
include '../Modelo/cnx.php';
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
and calificacion_olimpista=100 and
 solucion_olimpista.tipo_solucion='entrenamiento'
GROUP BY 
 problema.nombre_problema, 
  problema.id_problema, 
  solucion_olimpista.calificacion_olimpista
    order by count(*) desc;
  ;
";

$listaProble=  pg_query($sql);
echo" <table border=1> 
<tr><td>Posicion</td><td>Nombre Problema</td><td>Cantidad de veses resueltos</td></tr>    
";
$i=0;
while($fila = pg_fetch_array($listaProble))
{
    $i++;
    if($i<5)
    {
    echo "<tr><td>$i</td>
              <td>".$fila['nombre_problema']."</td>
              <td>".$fila['count']."</td></tr>";

    }
}
echo "</table>";

?>



</div>

</body>
</html>