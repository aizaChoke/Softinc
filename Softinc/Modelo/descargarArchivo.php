 <?php
 include 'cnx.php';
 pg_connect($entrada);
$id = $_GET['id']; 
$qry = "SELECT nombre_archivo FROM archivo WHERE id_archivo =$id;";
$res = pg_query($qry);
while($nombreArchivo = pg_fetch_array($res))
{
 $dato=$nombreArchivo['nombre_archivo'];
}
//echo $dato;
//header("Content-Disposition: attachment; filename=../archivo_comite/$id/.$dato.pdf");
//header("Content-Type: application/force-download");    
//header ("Content-Length: ".filesize("../archivo_comite/$id/$dato.pdf"));
readfile("../archivo_comite/$id/$dato.pdf");

// header( "Status: 301 Moved Permanently", false, 301);
//header("Location: ../vista/descargar_archivo.php");
//exit();
 ?> 