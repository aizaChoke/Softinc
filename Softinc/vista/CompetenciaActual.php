<!DOCTYPE html>
<html>
    <head>
                <script type="text/javascript" src="../vista/js/1.js"></script>
        <title></title>
        <script type="text/javascript" src="jquery-1.10.2.js"></script>
        <link rel="StyleSheet" href="../vista/css/1.css" type="text/css">

<script>
function realizaProceso(valorCaja1){
        var parametros = {
                "valorCaja1" : valorCaja1
        };
        $.ajax({
                data:  parametros,
                url:   'File.php',
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
        <div id="tabla">
        <?php 
        include '../modelo/Competencia.php';
        $competencia=new Competencia();
        echo $competencia->CompetenciaActual();
        ?>
        </div>
        <div id="resultado">
            Resultado: <span id="resultado"></span>
            <a href="#" onclick="borrar();" id="cerrar" style="visibility: hidden;">Cerrar tabla</a>
        </div>
    </body>
</html>