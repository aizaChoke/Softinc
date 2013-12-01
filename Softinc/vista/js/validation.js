function noVacio()
{

	$(document).ready(function() {  
	    <!--      Activamos la validación sobre el formulario -->  
	    $("#entityDataForm").validate({  
	        errorContainer: "#errores",  
	        errorLabelContainer: "#errores ul",  
	        wrapper: "li",  
	            errorElement: "em",  
	            rules: {  
	                login:   {required: true, remote: {url: "check-login.php", type: "get"}},  
	                pass:    {required: true, minlength: 4},  
	                pass2:   {required: true, minlength: 4, equalTo: "#pass"},                
	                name:    {required: true},        
	                email:   {required: true,  email: true},  
	                website: {required: false, url: true},  
	                fnac:    {required: false, date: true},  
	                antiguedad:  {required: true, number: true, min: 1, max: 50},  
	                numPersonas: {required: true, range: [0, 1000]},  
	                secreto:     {basicoCaptcha: 10}  
	            },  
	        messages: {  
	            login:   {  
	                required: "Campo requerido: Login",  
	                remote:   "Ya existe un usuario con ese login"  
	            },  
	            email:       {  
	                required: "Campo requerido: E-Mail",  
	                email:    "Formato no valido: E-Mail"  
	            },  
	            secreto: {  
	                basicoCaptcha: "Introduzca el secreto"  
	            }  
	            }  
	    });  
	    $.validator.methods.basicoCaptcha = function(value, element, param) {return value == param;};  
	      
	    <!--  Cuándo hagamos clic en el enlace manual mostraremos el número de errores del formulario -->  
	    $("#manual").click(function() {  
	          alert("¿Formulario válido?: " + $("#entityDataForm").validate().form());  
	          alert("Existen " + $("#entityDataForm").validate().numberOfInvalids() + " errores.");    
	    });  
	      
	    <!--  Cuándo hagamos clic en el enlace addRule agregaremos una regla de validación al campo con identificador campoX -->  
	    $("#addRule").click(function() {  
	            $("#campoX").rules("add", {  
	                required: true, minlength: 3,  
	                messages: {  
	                    required: "Ahora el campo es requerido",  
	                    minlength: jQuery.format("Son necesarios al menos {0} caracteres")  
	                }  
	            });  
	    });  
	});  
}