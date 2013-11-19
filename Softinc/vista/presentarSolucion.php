<html>
   <head>
    <meta charset="utf-8">
 
    
    <script  type="text/javascript" src="js/funcion.js"></script>
    
   
    
    <script src="js/jquery.js"></script>
	<script>window.jQuery || document.write("<script src='js/jquery-1.5.1.min.js'>\x3C/script>")</script>
	<script src="js/app.js"></script>
<!--     <link rel="stylesheet" href="css/base.css">-->
 <link rel="stylesheet" href="css/skeleton.css">
    
    
    
</head>
<body>

<br><center>
<h1 align="center">Presentar solucion </h1>
<div class="container">
		
<div class="form-bg">
<form class="contact_form" name="UserInformationForm" action="../Modelo/subirElArchivo.php" method="post" enctype="multipart/form-data" onSubmit="return validar()" >
   
<table>
<tr>
	<td>Seleccione lenguaje de programacion :</td>
        
</tr>

<tr> 
	<td>
            <select>
                <option value="java">Java</option>
                <option value="C">C</option>
                <option value="C++">C++</option>
            </select>
        </td>
</tr>
<tr>
    <td>Codigo de problema :</td>
</tr>
<tr><td><input type='text' id='num' name='titulo' size='40' maxlength='40' placeholder="codigo problema"  required /></td></tr>
<tr> 
	<td><input checked="checked" onclick="habilitarEscribirCodigo()" type='radio' id="seleccion1" name='subir' size='40' maxlength='40' value='Escriba codigo'  required /> Escriba codigo</td>
        <td><input  onclick="habilitarSeleccionarArchivo()"type='radio' id="seleccion2" name='subir' size='40' maxlength='40' value='Suba codigo' required /> Seleccionar archivo</td>
        
</tr>

<td>Codigo fuente :</td>

<tr>
	<td colspan='3' > <textarea id = 'texto' rows='5' name='codigoFuente' cols='40'  placeholder="escriba codigo fuente"  > </textarea>
</tr>


<td colspan='3'><input id="codigo" name='programa' type='file' size='35' />
</table>

<input type='submit' name='enviar' value='juzgar Codigo' id="boton" require />
</form>

    
    
<div align="center"><br>
  <div align="center"> 
 
</div>
</body>
</html>





