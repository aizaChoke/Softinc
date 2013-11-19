<?php
session_start();
$id_usuario= $_SESSION["id_usuario"];
echo $id_usuario;
?>
<html>
	<head>		
	</head>
	<body>
		<center>
		<br>
		<h1>Historia de problemas resueltos </h1>
		<div class="imagen">
		<br>
		<br>
		<?php
                
                 $id_usuario= $_SESSION["id_usuario"];
			include("../Modelo/cnx.php");
			pg_connect($entrada);
                        $sql = pg_query("SELECT 
  solucion_olimpista.codigo_solucion_olimpista,	
  problema.nombre_problema, 
  calificacion.nota_calificacion, 
  calificacion.mensaje_calificacion
  
FROM 
  public.usuario, 
  public.calificacion, 
  public.solucion_olimpista, 
  public.problema
WHERE 
  usuario.id_usuario = solucion_olimpista.id_usuario AND
  solucion_olimpista.id_solucion_olimpista = calificacion.id_calificacion AND
  solucion_olimpista.id_problema = problema.id_problema AND
  usuario.id_usuario=$id_usuario;
");
			echo "<table border = '1'> 
					<tr>
						<td>Codigo problema</td>
						<td>nombre problema</td>
						<td>Calificacion solucion</td>
						<td>Mensage solucion</td>
					</tr>";
			while($res = pg_fetch_array($sql)){
				echo "<tr>
						<td>".$res['codigo_solucion_olimpista']."</td>
						<td>".$res['nombre_problema']."</td>
						<td>".$res['nota_calificacion']."</td>
						<td>".$res['mensaje_calificacion']."</td>
					  </tr>";
			}
			echo "</table>";
		?>
		<br>
		<br>
                <a href = "Principal.html">Volver principal</a>
		</div>
		</center>
	</body>
</html>

?>