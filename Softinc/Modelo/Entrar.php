<?php
 
session_start();

 include("cnx.php");
 $cnx = pg_connect($entrada) or die ("Error de conexion. ". pg_last_error());
 
$user = $_POST['user'];
$pass = $_POST['pass'];
 
//$pass=sha1(md5($pass));

$seleccionar =  "SELECT usuario.*, rol.nombre_tipo
                FROM usuario, usuario_rol, rol
                where  usuario.id_usuario=usuario_rol.id_usuario and 
                usuario_rol.id_rol=rol.id_rol
                and user_usuario='$user' and pass_usuario='$pass';";
    
    $result  = pg_query($seleccionar) or die('ERROR AL OBTENER USUARIO: ' . pg_last_error());
    
    if (pg_numrows($result) > 0) {
        $datos = pg_fetch_array($result, null, PGSQL_ASSOC);
        $_SESSION["id_usuario"]      = $datos["id_usuario"];
        $_SESSION["nombre_rol"]      = $datos["nombre_tipo"];
        $_SESSION["nombre_usuario"]  = $datos["nombre_usuario"];
        $_SESSION["apellido_usuario"]= $datos["apellido_usuario"];
        $_SESSION["ci_usuario"]      = $datos["ci_usuario"];
        $_SESSION["user_usuario"]    = $datos["user_usuario"];
        $_SESSION["pass_usuario"]    = $datos["pass_usuario"];
        
        header('Location:../vista/aplicacion/index.php?nombre_rol='.$datos["nombre_tipo"].'&nombre_usuario='.$datos["nombre_usuario"].'&apellido_usuario='.$datos["apellido_usuario"].'');
        
//        header("Location: ../vista/aplicacion/index.php?nombre_rol=".$datos["nombre_tipo"]);
        
    } else {
        header("Location:../vista/pag-principal/");
    }
?>

