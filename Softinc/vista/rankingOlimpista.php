
<?php
include '../Modelo/cnx.php';
pg_connect($entrada);

$sqlproblema="
SELECT 
  solucion_olimpista.codigo_solucion_olimpista, 
  calificacion.nota_calificacion,
  count(*)
FROM 
  public.solucion_olimpista, 
  public.calificacion
WHERE 
  solucion_olimpista.id_solucion_olimpista = calificacion.id_solucion_olimpista
  GROUP BY 
  codigo_solucion_olimpista, 
  calificacion.nota_calificacion
  order by nota_calificacion desc;

";
$listaProble=pg_query($sqlproblema);
?>
<h1 align="center">Historia de problemas resueltos </h1> 
<?php
echo "<table border =1 align='center' >
    
  <tr><td>Nomproblema</td><td>Codigo problema</td><td>Calificacion</td><td>Problema  mas resuelto</td></tr>
";   
while($fila = pg_fetch_array($listaProble))
{
    $nombrecproblema=nombreProblema($fila['codigo_solucion_olimpista']);
    echo "
        <tr>
        <td>".$nombrecproblema."</td>
        <td>".$fila['codigo_solucion_olimpista']."</td>
        <td>".$fila['nota_calificacion']."</td>
        <td>".$fila['count']."</td>
        </tr>  
        ";
}

echo "</table>";


/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function nombreProblema($num)
{
    
    $nombre="SELECT 
  problema.nombre_problema
FROM 
  public.problema
where 
problema.id_problema=$num;";
    
 $nombrePro=pg_query($nombre);
    
    $nombreProblema=pg_fetch_array($nombrePro);
return $nombreProblema[0];
}
?>
