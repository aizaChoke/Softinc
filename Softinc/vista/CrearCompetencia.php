<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script type="text/javascript" src="../vista/js/1.js"></script>
        <link rel="StyleSheet" href="../vista/css/Decoracion.css" type="text/css">
        <link rel="stylesheet" type="text/css" media="all" href="calendario/jsDatePick_ltr.min.css" />
        <script type="text/javascript" src="calendario/jsDatePick.min.1.3.js"></script>
        <link rel="stylesheet" type="text/css" media="all" href="jsDatePick_ltr.min.css" />
        <script type="text/javascript" src="js/funcion.js"></script>
       <script type="text/javascript" src="js/prototype.js"></script>
       
       <script type="text/javascript">
	window.onload = function(){
		new JsDatePick({
			useMode:2,
			target:"fecha_inicio",
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
                new JsDatePick({
			useMode:2,
			target:"fecha_fin",
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
    </head>
    <body>
       
        <form action="../controlador/Competencia.php" method="post" onSubmit="return fechas();">
          
        <h1 align="center">Cree una nueva competencia</h1>
        <div align="center">
          <table>  
            <tr><td>Nombre de la competencia:</td></tr><tr><td><input type="text" size='35' min="1"            name="nombre_competencia" placeholder="Nombre de la competencia"></td></tr>
            <tr><td>Fecha de inicio:</td></tr><tr><td><input type="text" size='35' min="1" id='fecha_inicio'    name="fecha_inicio" placeholder="Fecha creacion"></td></tr>
            <tr><td>Hora de inicio:</td></tr><tr><td><input type="text" size='35' min="1" id='hora_ini'             name="hora_ini" onKeyPress="return FormatoHora(event,this)"  placeholder="Hora inicio"></td></tr> 
            <tr><td>Fecha de fin:</td></tr><tr><td><input type="text" size='35' min="1" id='fecha_fin'          name="fecha_fin" placeholder="Fecha fin"><br>
            <tr><td>Hora de fin:</td></tr><tr><td><input type="text" size='35' min="1" id='hora_fin'            name="hora_fin" onKeyPress="return FormatoHora(event,this)" placeholder="Hora fin"></td></tr>
            
            
            <tr><td> Configuracion de lenguaje:</td></tr><tr><td> 
              java:<input type="CHECKBOX" name="configurador[]" value='1'>
              c:   <input type="CHECKBOX" name="configurador[]" value='2'>
              c++: <input type="CHECKBOX" name="configurador[]" value='3'></td>
           <td>
          </table>
          <input type="submit" value="Crear Competencia" name="crear_competencia">
        </div>
        </form>
        
    </body>
</html>