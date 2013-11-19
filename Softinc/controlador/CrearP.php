
 <?php
 if(isset($_POST['crear'])){
    require '../modelo/CreadorArchivos.php';
    $archivo=$_FILES['enunciado']['name'];
    $rescatado=$_REQUEST['nombre'];
    $servidor=$_FILES['enunciado']['tmp_name'];
    $creador=new CreadorArchivos();
    $mensaje=$creador->subir($archivo, $servidor, $rescatado);
    require '../vista/AgregarArchivos.php';
 }

 ?>
