<?php
if(isset($_POST['competencia'])){
$competencia=$_POST['competencia'];

require '../modelo/Consulta.php';
$consulta=new Consulta();
echo $consulta->generarProblemasCompetencia($competencia);
}
?>
