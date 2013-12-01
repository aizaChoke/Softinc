<body>
<h1 align="center">Tabla competencia</h1>
    <div align="center">
  <?php
include '../Modelo/cnx.php';
pg_connect($entrada);


$idCompetecia=$_GET['id'];

$nombre=array();
$apellido=array();
$intentos=array();
$aseptado=array();


 
$listaProblema=listaProblemaCompetencia($idCompetecia);
echo "<table border=1>";
echo "<tr><td>Nombre</td><td>Apellido</td>";
while($listaProbleCom= pg_fetch_array($listaProblema))
{
    echo "<td>Problema:".$listaProbleCom['nombre_problema']." </td>";
    
}
echo "</tr>";
$listaUsuario=listaCompetencia($idCompetecia);
while( $dato =  pg_fetch_array($listaUsuario))
{
      
echo "<tr>";
echo "<td>".$dato['nombre_usuario']."</td>";
echo "<td>".$dato['apellido_usuario']."</td>";
$listaProblemaNombre=listaProblemaCompetencia($idCompetecia);
while($problema=  pg_fetch_array($listaProblemaNombre))
{    
      echo "<td>
                Solucion:".respuesta($problema['nombre_problema'], $dato['user_usuario'],$idCompetecia)."<br>
                Cantidad :".numeroIntento($problema['nombre_problema'], $dato['user_usuario'],$idCompetecia)."   
                
           </td>";
}
echo "</tr>";
}
echo "</table>";
 

function respuesta($nombreProblema, $user,$id)
{
    $sql="SELECT  
  solucion_olimpista.tipo_solucion, 
  solucion_olimpista.id_competencia_olimpista, 
  rol.nombre_tipo, 
  solucion_olimpista.calificacion_olimpista, 
  solucion_olimpista.mensage_calificacion, 
  usuario.nombre_usuario, 
  usuario.apellido_usuario, 
  usuario.user_usuario, 
  problema.nombre_problema
FROM 
  public.usuario, 
  public.usuario_rol, 
  public.rol, 
  public.solucion_olimpista, 
  public.problema
WHERE 
  usuario.id_usuario = solucion_olimpista.id_usuario AND
  usuario_rol.id_usuario = usuario.id_usuario AND
  rol.id_rol = usuario_rol.id_rol AND
  problema.id_problema = solucion_olimpista.id_problema and
  solucion_olimpista.tipo_solucion= 'competencia' and
  usuario.user_usuario='$user' and
  problema.nombre_problema='$nombreProblema' and
  solucion_olimpista.calificacion_olimpista=100 and
  solucion_olimpista.id_competencia_olimpista=$id  
  ;";
    
    $calificado=  pg_query($sql);
    $cantidad=pg_num_rows($calificado);
    $res="mal resuelto";
    if($cantidad>=1)
    {
        $res="yes";
        
    }else{
        $res="mal resuelto";
    }
    return $res;
}
function numeroIntento($nombreProblema, $user , $id)
{
    $sql="SELECT  
  solucion_olimpista.tipo_solucion, 
  solucion_olimpista.id_competencia_olimpista, 
  rol.nombre_tipo,  
  usuario.nombre_usuario, 
  usuario.apellido_usuario, 
  usuario.user_usuario, 
  problema.nombre_problema,
  count(*)
FROM 
  public.usuario, 
  public.usuario_rol, 
  public.rol, 
  public.solucion_olimpista, 
  public.problema
WHERE 
  usuario.id_usuario = solucion_olimpista.id_usuario AND
  usuario_rol.id_usuario = usuario.id_usuario AND
  rol.id_rol = usuario_rol.id_rol AND
  problema.id_problema = solucion_olimpista.id_problema and
  solucion_olimpista.tipo_solucion= 'competencia' and
  usuario.user_usuario='$user' and
  problema.nombre_problema='$nombreProblema' and
  solucion_olimpista.id_competencia_olimpista=$id
GROUP BY
  solucion_olimpista.tipo_solucion, 
  solucion_olimpista.id_competencia_olimpista, 
  rol.nombre_tipo,  
  usuario.nombre_usuario, 
  usuario.apellido_usuario, 
  usuario.user_usuario, 
  problema.nombre_problema
  ;";
    
    $calificado=  pg_query($sql);
    $res=  pg_fetch_array($calificado);
    $cantidad=0;
    if($res['count']>0)
    {
        $cantidad=$res['count'];
        
    }else{
        $cantidad =0;
    }
    return $cantidad;
}


function listaCompetencia($idCompetencia)
{
   $sql="SELECT 
  usuario.id_usuario, 
  usuario.nombre_usuario, 
  usuario.apellido_usuario, 
  usuario.user_usuario, 
  competencia.id_competencia, 
  competencia.nombre_competencia, 
  competencia.fecha_inicio_competencia, 
  competencia.fecha_fin_competencia, 
  rol.nombre_tipo
FROM 
  public.usuario, 
  public.competencia, 
  public.competencia_usuario, 
  public.rol, 
  public.usuario_rol
WHERE 
  usuario.id_usuario = competencia_usuario.id_usuario AND
  competencia_usuario.id_competencia = competencia.id_competencia AND
  rol.id_rol = usuario_rol.id_rol AND
  usuario_rol.id_usuario = usuario.id_usuario and 
  rol.nombre_tipo='olimpista' and
  competencia.id_competencia=$idCompetencia;
";
   $res= pg_query($sql);    

   return $res;
}

function listaProblemaCompetencia($idCompetencia)
{
    $sql="SELECT 
  competencia.id_competencia, 
  competencia.nombre_competencia, 
  problema.nombre_problema, 
  problema.id_problema
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
?>
  
</div>
</body>