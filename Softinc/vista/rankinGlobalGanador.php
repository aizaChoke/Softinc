<body>
<div align="center">
  <?php
include '../Modelo/cnx.php';
pg_connect($entrada);

$Promedio=array();
$numEquipos=nunEquipo();
$nota=0;
$promedio=array();
$div=0;
$j=1;
for($i=1;$i<=$numEquipos;$i++)
{
    $listaProEquipo = listaProblemaEquipo($i);
    while($dato = pg_fetch_array($listaProEquipo))
    {
      
        $nota=$nota+mejorNota($i,$dato['id_problema']);
        $div++;
    }
    
    if($div!=0)
    {
         //echo "*".($nota/numproblemas())."*";
        $promedio[$j]=$nota/numproblemas();
   
    }else{
        
        $promedio[$j]=0;
    }
    $nota=0;
    $div=0;
    $j++;
}



arsort($promedio);
$pos=1;
echo "<table border=1>";

echo "<tr><td>Posicion</td><td>Equipo</td><td>Calificacion</td></tr>";

    foreach ($promedio as $key => $val) 
    {
        
        $equipo=nombreEquipo($key);
       echo "<tr>";
        echo "<td>$pos</td>";
        echo "<td>$equipo</td>";
        echo "<td>$val</td>";
       echo "</tr>";
//echo "*$key = $val*\n";
    $pos++;
    
    }

echo "</table>";



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
   equipo_usuario.id_equipo =$idEquipo
   GROUP BY 
   equipo.nombre_equipo, 
   solucion_olimpista.id_problema, 
   equipo_usuario.id_equipo
   order by solucion_olimpista.id_problema;";
    
    $listaProblemaEquipo=pg_query($sql);
    return $listaProblemaEquipo;
}

function mejorNota($idEquipo,$idProblema)
{
    $sql="SELECT 
  equipo.nombre_equipo, 
  solucion_olimpista.calificacion_olimpista, 
  problema.nombre_problema, 
  equipo.id_equipo, 
  problema.id_problema
FROM 
  public.solucion_olimpista, 
  public.usuario, 
  public.equipo, 
  public.equipo_usuario, 
  public.problema
WHERE 
  solucion_olimpista.id_usuario = usuario.id_usuario AND
  solucion_olimpista.id_usuario = equipo_usuario.id_usuario AND
  equipo.id_equipo = equipo_usuario.id_equipo AND
  problema.id_problema = solucion_olimpista.id_problema AND
  equipo.id_equipo=$idEquipo and
  problema.id_problema=$idProblema
  order by solucion_olimpista.calificacion_olimpista desc
  ;";
   $nota=pg_query($sql);
   $mejorNota=  pg_fetch_array($nota);
   return $mejorNota['calificacion_olimpista'];
    
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
?>
</div>
</body>>