   function validar() {
       
   var bandera=true;
    //alert('Debe Elegir una opcion en el combo!');
   var seleccionDato1 = document.getElementById("seleccion1").checked;
   var texto1 = document.getElementById("texto").value;
   var seleccionDato2 = document.getElementById("seleccion2").checked;
   var examinar = document.getElementById("codigo").value;
  //alert(seleccionDato);
   //  alert(seleccionDato1);
 
 /*var seleccionDato100 = document.getElementById("seleccion3").checked;
    alert("hola");
    
   alert(seleccionDato100);
        */
       
    
 if(seleccionDato1 == true )
   {
       
       if(texto1.length==0  )
       {
        alert("escriba");
        bandera=false;
       }
    }
   
     
 if(seleccionDato2 == true )
   {
       
       if(examinar.length==0  )
       {
        alert("suba");
        bandera=false;
       }
    }   
    if(bandera==true)
    {
        alert("Código subido exitosamente");
    }

   
    
 return bandera;
 }
 /*
window.onload=function(){
var boton= document.getElementById('num');
boton.addEventListener('click',validar, false);

}*/

function validarUsuario()
{
  var password =document.getElementById("passwordUsuario").value;
  var passwordRepetir =document.getElementById("repetirPasswordUsuario").value;
  var elem = document.getElementById(id);
   
  /*
   *
   * 
   **/
  
  
  var bandera=true;
  if(password.length < 2 && passwordRepetir.length < 2)
      {
          alert("ingreso muy pocos caracteres");
          bandera=false;
elem.style.borderColor = "blue";  
}
  if(password != passwordRepetir)
      {
          elem.style.borderColor = "blue";
          alert("password diferentes");
          bandera=false;
      }
      if(bandera==true)
          {
           alert("sus datos son correctos");   
          }
 return bandera;
 }
    /*
    var url= 'validar usuario.php';
    var parametros='usuario='+document.getElementById("usuario").value;
    var ajax=new Ajax.Updater(document.getElementById("usuario").value,url,{methods: 'get' ,parameters: parametros});
   
}
*/

function enviar(){
        var formulario=document.getElementById("formulario");
	var dato = document.getElementById("nombreProblema");
        var enunciado = document.getElementById("enunciado").value;
        var acierto=comprueba_extension( enunciado);
	if (dato.value.length!=0 && acierto==true){
		alert("Creando el problema");
		formulario.submit(); //enviamos el formulario
		return true;
	} else {
		alert("No seleciono ningun archivo" + enunciado);
		return false;
	}
}

function comprueba_extension(archivo) {
    
   extensiones_permitidas = new Array(".pdf"); 
   mierror = ""; 
   if (!archivo) { 
      	mierror = "No has seleccionado ningún archivo"; 
   }else{ 
      extension = (archivo.substring(archivo.lastIndexOf("."))).toLowerCase(); 
      permitida = false; 
      for (var i = 0; i < extensiones_permitidas.length; i++) { 
         if (extensiones_permitidas[i] == extension) { 
         permitida = true; 
         break; 
         } 
      } 
      if (!permitida) { 
         mierror = "Comprueba la extensión de los archivos a subir. \nSólo se pueden subir archivos con extensiones: " + extensiones_permitidas.join(); 
      	}else{ 
         return true; 
      	} 
   } 

   return false; 
} 


function validarUsurio()
{ 
  var parametros='usuario='+document.getElementById("comprobaruaurio").value; 
 var consulta=document.getElementById("comprobaruaurio").value;
  alert(consulta);
           $("#resultado").delay(1000).queue(function(n) {      
                                         
                $("#resultado").html('<img src="ajax-loader.gif" />');
                                         
                      $.ajax({
                            type: "POST",
                            url: "comprobar.php",
                            data: "login="+consulta,
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
   
  
}
 
 function habilitarEscribirCodigo(){
    
     document.getElementById('codigo').disabled=true;
     document.getElementById('texto').disabled=false;
     
}
 function habilitarSeleccionarArchivo(){
    
     document.getElementById('codigo').disabled=false;
     document.getElementById('texto').disabled=true;
}