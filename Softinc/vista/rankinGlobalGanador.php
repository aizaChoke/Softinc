<body>
<div align="center">
    <h1 align="center">Ranking  de los 5 mejores olimpista</h1>
  <?php
  
include '../Modelo/cnx.php';
pg_connect($entrada);

$listaOlimpistaUsuario=listaOlimpista();
$i=0;
$nombre=array();
$apellido=array();
$promedio=array();
$cantidadProblema=array();
$numeroResueltoPorOlimpista=array();

while($dato= pg_fetch_array($listaOlimpistaUsuario))
{
     if(sacarPromedio($dato['user_usuario'])> 50)
     {
     $nombre[]=$dato['nombre_usuario'];
     $apellido[]=$dato['apellido_usuario'];
     $promedio[]=sacarPromedio($dato['user_usuario']);
     $cantidadProblema[]=cantidad();
     $numeroResueltoPorOlimpista[]=numeroDevesesResuelto($dato['user_usuario']);
     }
$i++;
}

arsort($promedio);
$pos=1;
echo "<table border=1>";

echo "<tr><td>Posicion olimpista</td><td>Nombre</td><td>Apellido</td><td>Calificacion</td><td>total problema</td><td>Catidad problemas resultos</td></tr>";

    foreach ($promedio as $key => $val) 
    {
        
        if($pos<=5)
        {
       echo "<tr>";
        echo "<td>$pos</td>";
        echo "<td>$nombre[$key]</td>";
        echo "<td>$apellido[$key]</td>";
        echo "<td>$val</td>";
        echo "<td>$cantidadProblema[$key]</td>";
        echo "<td>$numeroResueltoPorOlimpista[$key]</td>";
       echo "</tr>";
//echo "*$key = $val*\n";
    $pos++;
        }
    }

echo "</table>";


function numeroDevesesResuelto($user)
{
    $sql="
SELECT 
  usuario.user_usuario, 
  problema.nombre_problema,
  count(*)
FROM 
  public.problema, 
  public.usuario, 
  public.solucion_olimpista
WHERE 
  problema.id_problema = solucion_olimpista.id_problema AND
  usuario.id_usuario = solucion_olimpista.id_usuario and
  usuario.user_usuario='$user'
GROUP BY
  usuario.user_usuario, 
  problema.nombre_problema
  ;        
";
$result=pg_query($sql);    
$res=pg_num_rows($result);
return $res;
}

function sacarPromedio($nombreusuario)
{
    $sql="
SELECT  
  usuario.nombre_usuario, 
  usuario.apellido_usuario, 
  usuario.user_usuario, 
  solucion_olimpista.tipo_solucion, 
  solucion_olimpista.id_competencia_olimpista, 
  rol.nombre_tipo, 
  problema.nombre_problema, 
  count(*)
FROM 
  public.usuario, 
  public.solucion_olimpista, 
  public.usuario_rol, 
  public.rol, 
  public.problema
WHERE 
  usuario.id_usuario = solucion_olimpista.id_usuario AND
  usuario_rol.id_usuario = usuario.id_usuario AND
  rol.id_rol = usuario_rol.id_rol AND
  problema.id_problema = solucion_olimpista.id_problema and
  rol.nombre_tipo='olimpista' and 
   solucion_olimpista.tipo_solucion='entrenamiento' and 
  solucion_olimpista.id_competencia_olimpista=0 and
  usuario.user_usuario='$nombreusuario'
 GROUP BY 
  usuario.nombre_usuario, 
  usuario.apellido_usuario, 
  usuario.user_usuario, 
  solucion_olimpista.tipo_solucion, 
  solucion_olimpista.id_competencia_olimpista, 
  rol.nombre_tipo, 
  problema.nombre_problema;";
 $res=  pg_query($sql);
 $nota=0;
 while($dato= pg_fetch_array($res))
 {
     $nota=$nota+notaProblemaMayor($nombreusuario,$dato['nombre_problema']);
     
 }
  $res=$nota/cantidad(); 
 
 return $res;
}

function notaProblemaMayor($nombreUsuario,$nombreProblema)
{
    $sql="
SELECT  
  usuario.nombre_usuario, 
  usuario.apellido_usuario, 
  usuario.user_usuario, 
  solucion_olimpista.calificacion_olimpista, 
  solucion_olimpista.tipo_solucion, 
  solucion_olimpista.id_competencia_olimpista, 
  rol.nombre_tipo, 
  problema.nombre_problema, 
  count(*)
FROM 
  public.usuario, 
  public.solucion_olimpista, 
  public.usuario_rol, 
  public.rol, 
  public.problema
WHERE 
  usuario.id_usuario = solucion_olimpista.id_usuario AND
  usuario_rol.id_usuario = usuario.id_usuario AND
  rol.id_rol = usuario_rol.id_rol AND
  problema.id_problema = solucion_olimpista.id_problema and
  rol.nombre_tipo='olimpista' and
  problema.nombre_problema ='$nombreProblema' and 
  solucion_olimpista.tipo_solucion='entrenamiento' and 
  solucion_olimpista.id_competencia_olimpista=0 and
  usuario.user_usuario='$nombreUsuario'
 GROUP BY 
  usuario.nombre_usuario, 
  usuario.apellido_usuario, 
  usuario.user_usuario, 
  solucion_olimpista.calificacion_olimpista, 
  solucion_olimpista.tipo_solucion, 
  solucion_olimpista.id_competencia_olimpista, 
  rol.nombre_tipo, 
  problema.nombre_problema
order by 
 solucion_olimpista.calificacion_olimpista  desc;        
";
   $nota= pg_query($sql);
   
   $res=  pg_fetch_array($nota);
   return $res['calificacion_olimpista'];
}
function cantidad()
{
    $sql="SELECT 
  count(*)
FROM 
  public.problema;
";
    $cantidad=  pg_query($sql);
    $res= pg_fetch_array($cantidad);
 return  $res['count'];  
}

function listaOlimpista()
{
    $sql="SELECT 
  usuario.user_usuario, 
  rol.nombre_tipo, 
  usuario.nombre_usuario, 
  usuario.apellido_usuario
FROM 
  public.usuario, 
  public.usuario_rol, 
  public.rol
WHERE 
  usuario_rol.id_usuario = usuario.id_usuario AND
  rol.id_rol = usuario_rol.id_rol and 
  rol.nombre_tipo='olimpista'
  ;

";
    
    $res= pg_query($sql);
    return $res;
}

?>
</div>
</body>