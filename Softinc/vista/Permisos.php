

<html>
<head>
    <link rel="StyleSheet" href="../vista/css/Decoracion.css" type="text/css">
<script language="JavaScript" type="text/JavaScript"> 
    function uncheckRadio() { 
        var choice = document.form1; 
            for (i = 0; i < choice.length; i++) { 
                    if ( choice[i].checked = true )  
                            choice[i].checked = false;  
                        } } //--> </script>
</head>
<body>
    <form action="../controlador/ControlRol.php" method="post" name="form1">

<?php
include '../Modelo/Consulta.php';
$consul=new Consulta();
echo $consul->generarPermisos();
?>

<input type="submit" value="modificar">
</form>
</body>
</html>
