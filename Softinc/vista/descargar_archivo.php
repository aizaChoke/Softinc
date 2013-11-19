 <?php 
 echo "<h1 align='center'>Lista de problemas de la olimpiada </h1>";
include '../Modelo/cnx.php';
pg_connect($entrada);
$qry = "SELECT 
  problema.nombre_problema, 
  problema.id_problema
FROM 
  public.problema;
";
$res = pg_query($qry);

echo "<table border =1 align='center' >";
echo "<tr><td>Nombre de los archivos </td> <td> Seleccione archivo a descargar </td></tr>";
while($fila = pg_fetch_array($res))
{
echo "<tr>";
    echo " <td>".$fila['nombre_problema']."</td>";
echo "<td>  <a href= '../Modelo/descargarArchivo.php? id=$fila[id_problema]' >  Descargar</a> </td>" ; 
echo "</tr>";
}
echo "</table>";
?> 