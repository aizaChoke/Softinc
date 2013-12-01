 <?php
 include 'cnx.php';
 pg_connect($entrada);
$id =$_GET['id'];

$qry = "SELECT 
  problema.id_problema
FROM 
  public.problema
where 
problema.id_problema=$id;
";
$res = pg_query($qry);
$nombreArchivo =pg_fetch_array($res);
$dato=$nombreArchivo['id_problema'];
header("Content-Disposition: attachment; filename=../archivo_comite/$id/.$dato.pdf");
header("Content-Type: application/force-download");    
header ("Content-Length: ".filesize("../archivo_comite/$id/$dato.pdf"));
readfile("../archivo_comite/$id/$dato.pdf");
// header( "Status: 301 Moved Permanently", false, 301);
//header("Location: ../vista/descargar_archivo.php");
//exit();
 ?> 