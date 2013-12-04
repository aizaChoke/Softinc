<body>
<div align="center">
  <?php
include '../Modelo/cnx.php';
pg_connect($entrada);

$listaProblemaEntrenamiento=listaProblema();
$cantidad=totalProgramaCantidad();
echo " <h1 align='center'>Estadisticas de los problemas <br> resueltos correctamente</h1> ";
echo "<h3> (problemas que obtubieron YES )  </h3>";
echo "<table border=1>
 <tr><td>Id problema </td> 
 <td>Nombre problema</>
 <td>%Problema resulto </td>
 <td>Intento</td>
</tr>
";
$i=1;
while($dato=pg_fetch_array($listaProblemaEntrenamiento))
{
    $bueno=0;
    $intento=0;
    $porsentageBien=cantidadResueltoBien($dato['nombre_problema']);
       
    
    if($porsentageBien['count']>0)
    {
        $bueno= ($porsentageBien['count']*100)/$cantidad;
        $intento=$porsentageBien['count'];
    }
    $malo=100-$bueno;
    echo "<tr>
        <td>$i</td>
        <td>".$dato['nombre_problema']."</td>
        <td>%".$bueno."</td>
        <td>".$intento."</td>    
         </tr>";
    $i++;
}

echo "</table>";
function listaProblema()
{
    $sql="SELECT 
  problema.id_problema, 
  problema.nombre_problema
FROM 
  public.problema;
";

    $res=pg_query($sql);
    return $res;
}

function totalProgramaCantidad()
{
    $sql="SELECT 
  solucion_olimpista.calificacion_olimpista ,
  solucion_olimpista.tipo_solucion, 
  solucion_olimpista.id_competencia_olimpista,
  count(*)
FROM 
  public.solucion_olimpista, 
  public.problema
WHERE 
  problema.id_problema = solucion_olimpista.id_problema and 
  solucion_olimpista.calificacion_olimpista=100 and
  solucion_olimpista.tipo_solucion='entrenamiento' and 
  solucion_olimpista.id_competencia_olimpista=0
 GROUP BY
  solucion_olimpista.calificacion_olimpista ,
  solucion_olimpista.tipo_solucion, 
  solucion_olimpista.id_competencia_olimpista
  ; 
";
    $res1=pg_query($sql);
    $res=  pg_fetch_array($res1);
  return $res['count'];
  
}


//---------------------
function cantidadResueltoMal($nombreProblema)
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
  problema.id_problema = solucion_olimpista.id_problema  and 
  solucion_olimpista.tipo_solucion='entrenamiento' and 
  solucion_olimpista.id_competencia_olimpista = 0 and
  solucion_olimpista.calificacion_olimpista < 100 and
  problema.nombre_problema='$nombreProblema'
  GROUP BY
  problema.id_problema, 
  problema.nombre_problema, 

  solucion_olimpista.tipo_solucion, 
 solucion_olimpista.id_competencia_olimpista 
order by count(*) desc; 
 ";
    
    $res1=  pg_query($sql);
    $res=  pg_fetch_array($res1);
    return $res;
}

function cantidadResueltoBien($nombreProblema)
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
  problema.id_problema = solucion_olimpista.id_problema  and 
  solucion_olimpista.tipo_solucion='entrenamiento' and 
  solucion_olimpista.id_competencia_olimpista = 0 and
  solucion_olimpista.calificacion_olimpista = 100 and
  problema.nombre_problema='$nombreProblema'
  GROUP BY
  problema.id_problema, 
  problema.nombre_problema, 

  solucion_olimpista.tipo_solucion, 
 solucion_olimpista.id_competencia_olimpista 
order by count(*) desc; 
 ";
    
   $res1=  pg_query($sql);
    $res=  pg_fetch_array($res1);
    return $res;
}
?>
</div>
</body>