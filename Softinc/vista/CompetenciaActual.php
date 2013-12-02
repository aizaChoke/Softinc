<!DOCTYPE html>
<html>
    <head>
                <script type="text/javascript" src="../vista/js/1.js"></script>
        <title></title>
        <script type="text/javascript" src="jquery-1.10.2.js"></script>
        <link rel="StyleSheet" href="../vista/css/1.css" type="text/css">
        <link rel="StyleSheet" href="../vista/css/Decoracion.css" type="text/css">

<script>
function realizaProceso(id_competencia){
        var parametros = {
                "id_competencia" : id_competencia
        };
        $.ajax({
                data:  parametros,
                url:   'ProblemasCompetencia.php',
                type:  'post',
                beforeSend: function () {
                        $("#resultado").html("Procesando, espere por favor...");
                },
                success:  function (response) {
                        $("#resultado").html(response);
                           document.getElementById("cerrar").style.visibility="visible";
                }
        });
}

</script>
    </head>
    <body>
        <div id="formulario">
        <h2>COMPETENCIAS EN SERVICIO</h2>
        <div id="tabla">
        <?php 
        include '../modelo/ConsultaCompetencia.php';
        $competencia=new ConsultaCompetencia();
        echo $competencia->CompetenciaActual();
        ?>
        <a href="#" onclick="borrar();" id="cerrar" style="visibility: hidden;">Cerrar Problemas</a>
        </div>
        <div id="resultado">
            <span id="resultado"></span><br>
            
            

        </div>
        </div>
    </body>
</html>