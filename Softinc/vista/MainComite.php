<!DOCTYPE html>
<html>
    <head>
                <script type="text/javascript" src="../vista/js/1.js"></script>
                <link rel="StyleSheet" href="../vista/css/1.css" type="text/css">
    </head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <div id="menu">
<ul id="menu1">
            <input type="button" value="Ver Perfil" onclick="javascript:perfil();"><br>
 <li>Problema
        <ul>
            <li><a onclick="javascript:problema();"><input type="button" value="Crear Problema"></a></li>
            <li><a onclick="javascript:subir_archivos();"><input type="button" value="Subir Archivos"></a></li>
            <li><a onclick="javascript:eliminar_problema();"><input type="button" value="Eliminar Problema"></a></li>
            <li><a onclick="javascript:verProblema();"><input type="button" value="Ver Problema"></a></li>
        </ul>
  </li>
  <li>Competencia
        <ul>
            <li><a onclick="javascript:crear_competencia();"><input type="button" value="Crear Competencia"></a></li>
            <li><a onclick="javascript:dddddd();"><input type="button" value="Competencia en servicio"></a></li>
            <li><a onclick="javascript:concurso_proximo();"><input type="button" value="Proximas Competencias"></a></li>
            <li><a onclick="javascript:dsadsa();"><input type="button" value="Anteriores Competencias"></a></li>
        </ul>
  </li>
            <input type="button" value="Rankin" onclick="javascript:rankin();"><br>
            <a href="Salir.php"><input type="button" value="Salir"></a><br>
</ul>
        </div>
<script type="text/javascript">
<!--
iniciaMenu('menu1');
//-->
</script>
        <div id="cambio">
            <iframe   width="1020" height="600" scrolling="yes" id="iMarco" >
        </div>
        
    </body>
</html>
