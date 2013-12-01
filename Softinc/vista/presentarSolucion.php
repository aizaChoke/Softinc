<html>
   <head>
    <meta charset="utf-8">
 
    
    <script  type="text/javascript" src="js/funcion.js" > </script>
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

<tr><td><input type='hidden' id='tipoSolucion' name='tipoSolucion' size='40' value="entrenamiento" maxlength='40' placeholder="codigo problema"  required OnFocus="this.blur()"/></td></tr>

</tr>
    <td>Numero competencia:</td>
</tr>
 <?php echo "<tr><td><input type='hidden' id='idCompetencia' name='idCompetencia' size='40' value='0' maxlength='40' placeholder='codigo problema'  required OnFocus='this.blur()' /></td></tr>" ?>; 
<tr>
<tr> 
	<td>
            <select name="tipoCodigo">
                <option  value="java">Java</option>
                <option  value="C">C</option>
                <option value="C++">C++</option>
            </select>
        </td>
</tr>
<tr>
    <td>Codigo de problema :</td>
</tr>
<tr><td><input type='text' id='num' name='titulo' size='40' maxlength='40' placeholder="codigo problema"  required /></td></tr>
<tr> 
	<td><input checked="checked"  type='radio' id="seleccion1" name='subir' size='40' maxlength='40' value='Escriba codigo' onClick="bloquea()" required /> Escriba codigo</td>
        <td><input  type='radio' id="seleccion2" name='subir' size='40' maxlength='40' value='Suba codigo' onClick="bloquea()" required /> Seleccionar archivo</td>
        
</tr>

<td>Codigo fuente :</td>

<tr>
	<td colspan='3' > <textarea id ='codigoFuente' rows='5' name='codigoFuente' cols='40'  placeholder="escriba codigo fuente"  ></textarea>
</tr>


<td colspan='3'><input id="programa" name='programa' type='file' size='35' />
</table>

<input type='submit' name='enviar' value='juzgar Codigo' id="boton" require />
</form>

    
    
<div align="center"><br>
  <div align="center"> 
 
</div>
</body>
</html>





