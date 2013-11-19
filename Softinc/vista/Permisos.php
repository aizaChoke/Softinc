

<html>
<head>
<title>Prueba de formulario</title>
</head>
<body>
<form action="../controlador/ControlRol.php" method="post">

<?php
include '../Modelo/Consulta.php';
$consul=new Consulta();
echo $consul->generarPermisos();
?>

<input type="submit" value="modificar">
</form>
</body>
</html>
