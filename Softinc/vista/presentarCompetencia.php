<?php
$idPRoblema=1;
$idCompetencia=$_POST['id_competencia'];
//echo "$idCompetencia";
require '../Modelo/datosPresentarCompetencia.php';

$dato= new presentarCompetenciaConsulta();
$mensaje=$dato->lenguages($idCompetencia);


?>

<html>
   <head>
    <meta charset="utf-8">
    <script  type="text/javascript" src="js/funcion.js" > </script>
    <script src="js/jquery.js"></script>
    <script>window.jQuery || document.write("<script src='js/jquery-1.5.1.min.js'>\x3C/script>")</script>
    <script src="js/app.js"></script>
    <link rel="stylesheet" href="css/skeleton.css">
    
    
    
</head>
<body>

<br><center>
<h1 align="center">Presentar solucion </h1>
<div class="container">
		
<div class="form-bg">
<form class="contact_form" name="UserInformationForm" action="../Modelo/subirElArchivo.php" method="post" enctype="multipart/form-data" onSubmit="return validar()" >
   
<table>
<td><input type='hidden' id='tipoSolucion' name='tipoSolucion' size='40' value='competencia' maxlength='40' placeholder="codigo problema"  required OnFocus="this.blur()"/></td></tr>

 <?php echo "<tr><td><input type='hidden' id='idCompetencia' name='idCompetencia' size='40' value='$idCompetencia' maxlength='40' placeholder='codigo problema'  required OnFocus='this.blur()' /></td></tr>" ?>; 
<tr>
<tr>
	<td>Seleccione lenguaje de programacion :</td>
        
</tr>

<tr> 
	
            
             <?php  echo "<td><select name='tipoCodigo'>";
		while($date = pg_fetch_array($mensaje))
 		{
   			echo "<option >".$date['nombre_lenguaje']."</option>"; 
  		}
		echo "</select>";
	      echo "</td>";
        ?>
            </select>
        
</tr>
<tr>
    <td>Codigo de problema :</td>
</tr>
   <?php echo "<tr><td><input type='text' id='titulo' name='titulo' value ='' size='40' maxlength='40' placeholder='codigo problema'  required /></td></tr>" ?>
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




