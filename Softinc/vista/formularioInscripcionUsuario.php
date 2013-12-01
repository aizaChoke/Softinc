<html>
<head>
<title>Registro Usuarios</title>
	<link rel="stylesheet" type="text/css" media="all" href="calendario/jsDatePick_ltr.min.css" />
<script type="text/javascript" src="calendario/jsDatePick.min.1.3.js"></script>
<script type="text/javascript" src="js/funcion.js"></script>
 <script type="text/javascript" src="js/prototype.js"></script>
<script type="text/javascript">
	window.onload = function(){
		new JsDatePick({
			useMode:2,
			target:"inputField",
			dateFormat:"%Y-%m-%d"
			/*selectedDate:{				This is an example of what the full configuration offers.
				day:5,						For full documentation about these settings please see the full version of the code.
				month:9,
				year:2006
			},
			yearsRange:[1978,2020],
			limitToToday:false,
			cellColorScheme:"beige",
			dateFormat:"%m-%d-%Y",
			imgPath:"calendario\img",
			weekStartDay:1*/
		});
	};


</script>
 <link rel="stylesheet" href="css/base.css">
 <link rel="stylesheet" href="css/skeleton.css">
  <link rel="stylesheet" href="css/layout.css">
</head>
<body>

<div id="formulario">
    <center>    
        <form  action="../Modelo/inscribirUsuario.php"  method="post" enctype="multipart/form-data" onSubmit="return validarUsuario()" >
            <table>
                <tr>
                    <td style="text-align: center;"><h2>Registro Usuario</h2></td>
                </tr>
                <tr>
                    <td><input type='text' id ='NombreUsuario' name='NombreUsuario'  size='40' maxlength='40' placeholder="Nombre " required  pattern="([A-Z,a-z]{5,20})">  </td>
                </tr>
                <tr>
                    <td><input type='text' name='ApellidoPaternoUsuario' size='40' maxlength='40' placeholder="Apellido paterno " required pattern="([A-Z,a-z]{5,20})"/></td>
                </tr>
                <tr>
                    <td><input type='text' name='ApellidoMaternoUsuario' size='40' maxlength='40'  placeholder="Apellido materno " required pattern="([A-Z,a-z]{5,20})"/></td> 
                </tr>
                <tr>
                    <td><input type ='text'  name='CiUsuario' size='40' min="1" max="10" maxlength='7' placeholder="CI: 2415125"  pattern="([0-9]{7})" required /></td>
                </tr>
                <tr>
                    <td><input type ='text'  name='unidadEducativaUsuario' size='40'  maxlength='40' placeholder="Institucion" required   /></td>
                </tr>
                <tr>
                    <td><input type ='text'  name='fechaUsuario' id='inputField' size='40' maxlength='40' placeholder="Fecha de nacimiento" required pattern="\d{4}-\d{1,2}-\d{1,2}" /></td>
                </tr>
                <tr>
                    <td><input type ='email'  name='EmailUsuario' id='EmailUsuario' size='40' maxlength='40' placeholder="correo@example.com" required /></td>
                </tr>
                <tr>
                    <td><input type='text' name='usuarioUsuario' onBlur="validarusuarioformulario(this)" id="usuarioUsuario"  size='40' maxlength='40' value="" placeholder="Nombre de usuario"  required /></td> 
                </tr>
                <tr><td><samp id="conprobarusuario"></samp><br/></td></tr>
                <tr>
                    <td><input type='password' id="passwordUsuario" name='passwordUsuario' size='40' maxlength='40'placeholder="Contraseña" required /></td>
                </tr>
                <tr>
                    <td><input type='password' id="repetirPasswordUsuario" name='repetirPasswordUsuario' size='40' maxlength='40'placeholder="Repetir contraseña" required/></td>
                </tr>
                <tr>
                    <td style="text-align: center;">
                        <div>
                            <button type="submit">Crear Cuenta</button>
                        </div>
                    </td>
                </tr>
            </table>
        </form>
    </center>
</div>
</body>
</html>

