<?php
 
session_start();

 include("cnx.php");
 $cnx = pg_connect($entrada) or die ("Error de conexion. ". pg_last_error());
 
$user = $_POST['user'];
$pass = $_POST['pass'];
 
//$pass=sha1(md5($pass));
 
    $seleccionar="SELECT usuario.id_usuario, nombre_usuario, apellido_usuario, ci_usuario, user_usuario, 
                  pass_usuario, institucion_usuario, fecha_nacimiento_usuario, 
                  email_usuario, rol.id_rol
                  FROM usuario, usuario_rol, rol
                  where  usuario.id_usuario=usuario_rol.id_usuario and 
                  usuario_rol.id_rol=rol.id_rol
                  and user_usuario='$user' and pass_usuario='$pass';";
    
    $result     = pg_query($seleccionar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
    


    if(pg_numrows($result)){
        $datos = pg_fetch_array($result, null, PGSQL_ASSOC);
       echo $_SESSION["id_usuario"]      = $datos["id_usuario"];
       echo $_SESSION["id_rol"]          = $datos["id_rol"];
       echo $_SESSION["nombre_usuario"]  = $datos["nombre_usuario"];
       echo $_SESSION["apellido_usuario"]= $datos["apellido_usuario"];
       echo $_SESSION["ci_usuario"]      = $datos["ci_usuario"];
       echo $_SESSION["user_usuario"]    = $datos["user_usuario"];
       echo $_SESSION["pass_usuario"]    = $datos["pass_usuario"];
       if(!strcmp($datos["id_rol"], "2")){
            header("Location: ../vista/MainComite.php");
       }
       else if(!strcmp($datos["id_rol"], "1")){
            header("Location: ../vista/MainADM.php");
       }
       else if(!strcmp($datos["id_rol"], "3")){
            header("Location: ../vista/MainOlimpista.php");
       }
} else {
 
echo "<h2>Login o Password Incorrectos</h2>";
 
}
 
?>

