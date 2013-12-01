   function validar() {
       
   var bandera=true;
    //alert('Debe Elegir una opcion en el combo!');
   var seleccionDato1 = document.getElementById("seleccion1").checked;
   var texto1 = document.getElementById("texto").value;
   var seleccionDato2 = document.getElementById("seleccion2").checked;
   var examinar = document.getElementById("programa").value;
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
        alert("escriva");
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
        alert("C�digo subido exitosamente");
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
  var bandera=true;

  if(password.length < 6 && passwordRepetir.length < 6)
      {
          alert("Ingrese minimo 6 caracteres en su password");
          bandera=false;
             
}
  if(password != passwordRepetir)
      {
          
          alert("password diferentes");
          bandera=false;
      }
      if(bandera==true)
          {
           alert("sus datos entan siendo enviados y veridicando");   
          }
    
  
 return bandedera;
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
		alert("Creando el problema" +"  "+dato.value);
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
      	mierror = "No has seleccionado ning�n archivo"; 
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
         mierror = "Comprueba la extensi�n de los archivos a subir. \nS�lo se pueden subir archivos con extensiones: " + extensiones_permitidas.join(); 
      	}else{ 
         return true; 
      	} 
   } 

   return false; 
} 



 //document.getElementById('campo').disabled=true;
// var seleccionDato1 = document.getElementById("seleccion1").checked;
function bloquea(){

if (document.getElementById("seleccion1").checked ==true) {
document.getElementById('programa').disabled=true;
document.getElementById('codigoFuente').disabled=false;
}

if (document.getElementById("seleccion2").checked ==true) {

document.getElementById('codigoFuente').disabled=true
document.getElementById('programa').disabled=false;
}


}


function validarusuarioEntrada(usuario)
{
	var url ='../js/comprobarUsuario.php';
	var parametros='user='+document.getElementById("user").value;
	var ajax = new Ajax.Updater('conprobarusuario',url,{method: 'get', parameters: parametros});
	
         
}

function validarusuarioformulario(usuario)
{
	var url ='js/comprobarfomulario.php';
	var parametros='usuarioUsuario='+document.getElementById("usuarioUsuario").value;
	var ajax = new Ajax.Updater('conprobarusuario',url,{method: 'get', parameters: parametros});
	 
         var cadenaEspacio= document.getElementById("usuarioUsuario").value;
         var re = /^[A-z]*$/;
       
           if (!isNaN(cadenaEspacio[0]))//(!re.test(cadenaEspacio[0]) && !re.test(cadenaEspacio[1]) &&!re.test(cadenaEspacio[2]) &&!re.test(cadenaEspacio[3])  )
             {              
                     alert("Deve comemensar con un caracter");   
             }   
             
          var iChars = "!@#$%^&*()+=-[]\\';,./{}|\":<>?";

           for (var i = 0; i < cadenaEspacio.length; i++) {
                if (iChars.indexOf(cadenaEspacio.charAt(i)) != -1 ) {
                    alert ("Solo letras y numeros");
        
                 }
                }
         
}

function desactivarCapoText(l_str_input) {
document.getElementById("titulo").disabled = true;
}