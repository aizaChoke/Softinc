<html>
<head>
<title>Registro Usuarios</title>
	<link rel="stylesheet" type="text/css" media="all" href="calendario/jsDatePick_ltr.min.css" />
<script type="text/javascript" src="calendario/jsDatePick.min.1.3.js"></script>
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
     <meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">	<!-- Force Latest IE rendering engine -->	
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 

 <script type="text/javascript" src="js/jquery-1.9.0.js"></script>
 <script type="text/javascript" src="js/jquery.validate.min.js"></script>
 <script type="text/javascript" src="js/funcion.js"></script>
 <script type="text/javascript">

$(document).ready(function(){
    
    var consulta;
           
    //hacemos focus
    $("#usuarioUsuario").focus();
                                             
    //comprobamos si se pulsa una tecla
    $("#usuarioUsuario").keyup(function(e){
           //obtenemos el texto introducido en el campo
           consulta = $("#usuarioUsuario").val();
                                    
           //hace la búsqueda
           $("#resultado").delay(1000).queue(function(n) {      
                                         
               
             $("#resultado").html('<img src="ajax-loader.gif" />');         
                      $.ajax({
                            type: "POST",
                            url: "js/comprobar.php",
                            data: "usuarioUsuario="+consulta,
                            dataType: "html",
                            error: function(){
                                  alert("error petición ajax");
                            },
                            success: function(data){                                                      
                                  $("#resultado").html(data);
                                  n();
                            }
                });
                                         
           });
                              
    });
                        
});

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
                    <td><input type='text' name='usuarioUsuario' id="usuarioUsuario"  size='40' maxlength='40' value="" placeholder="Nombre de usuario"  required /> <div id="resultado"></div></td> 
                </tr>
                <tr>
                    <td><input type='password' id="passwordUsuario" name='passwordUsuario' size='40' maxlength='40'placeholder="Contraseña" required /></td>
                </tr>
                <tr>
                    <td><input type='password' id="repetirPasswordUsuario" name='repetirPasswordUsuario' size='40' maxlength='40'placeholder="Repetir contraseña" required/></td>
                </tr>
                <tr>
                    <td style="text-align: center;">
                        <div>
                            <button type="submit">Abrir Cuenta</button>
                        </div>
                    </td>
                </tr>
            </table>
        </form>
    </center>
</div>
</body>
</html>

