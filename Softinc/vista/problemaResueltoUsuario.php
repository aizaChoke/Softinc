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
  solucion_olimpista.id_problema, 
  problema.nombre_problema, 
  solucion_olimpista.calificacion_olimpista, 
  solucion_olimpista.mensage_calificacion 
  
FROM 
  public.usuario, 
  public.solucion_olimpista, 
  public.problema
WHERE 
  solucion_olimpista.id_usuario = usuario.id_usuario AND
  problema.id_problema = solucion_olimpista.id_problema and
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
						<td>".$res['id_problema']."</td>
						<td>".$res['nombre_problema']."</td>
						<td>".$res['calificacion_olimpista']."</td>
						<td>".$res['mensage_calificacion']."</td>
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