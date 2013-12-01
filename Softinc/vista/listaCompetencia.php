 <?php 
 echo "<h1 align='center'>Lista de competencias </h1>";
include '../Modelo/cnx.php';
pg_connect($entrada);
$qry = "SELECT 
  competencia.id_competencia, 
  competencia.nombre_competencia, 
  competencia.fecha_inicio_competencia, 
  competencia.fecha_fin_competencia, 
  competencia.creador_competencia
FROM 
  public.competencia;
";
$res = pg_query($qry);

echo "<table border =1 align='center' >";
echo "<tr><td>Numero competencias </td><td>Lista copetencia</td> <td>Fecha inicio</td> <td>Fecha fin</td> <td>nombre creador competencia</td><td>Ingrese ranking</td></tr>";
while($fila = pg_fetch_array($res))
{
    $nombre=  nombreCreador($fila['creador_competencia']);
echo "<tr>";
    echo " 
        <td>".$fila['id_competencia']."</td>
        <td>".$fila['nombre_competencia']."</td>
        <td>".$fila['fecha_inicio_competencia']."</td>
        <td>".$fila['fecha_fin_competencia']."</td>
        <td>".$nombre."</td>
            
       ";
echo "<td>  <a href= 'listaCompetenciaRanking.php?id=$fila[id_competencia]'> Ingrese </a> </td>" ; 
echo "</tr>";
}
echo "</table>";

function nombreCreador($idComite)
{
    $sql="SELECT 
  usuario.nombre_usuario
  
FROM 
  public.usuario
where
  usuario.id_usuario=$idComite
  ;
";

    $usuario=  pg_query($sql);
    $nombre=  pg_fetch_array($usuario);
    
    return $nombre['nombre_usuario'];
}
?> 