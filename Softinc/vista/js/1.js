/*addEventListener('load', inicio, false);
function inicio(){
    document.getElementById('iMarco').innerHTML="hola";
}
*/
//administrador
function verUsuarios(){
    document.getElementById('iMarco').src="VerUsuarios.php";
}
function permisos(){
      document.getElementById('iMarco').src="Permisos.php"; 
}


//comite
function perfil(){
     document.getElementById('iMarco').src="Perfil.php";
}
function problema(){
     document.getElementById('iMarco').src="CreacionProblema.php";
}
function subir_archivos(){
     document.getElementById('iMarco').src="SubirArchivo.php";
}
function rankin(){
     document.getElementById('iMarco').src="hgfhgfhfhh.html";
}
function agregar_contenido(){
    
}

function eliminar_problema(){
     document.getElementById('iMarco').src="EliminarProblema.php";
}
function verProblema(){
       document.getElementById('iMarco').src="descargar_archivo.php";
    
}
function crear_equipo(){
       document.getElementById('iMarco').src="CrearEquipo.php";
    
}








//olimpista descargar_archivo
function descargar_archivo(){
     document.getElementById('iMarco').src="descargar_archivo.php";
}

function subirCodigo(){
     document.getElementById('iMarco').src="suvirProblemaJuez.php";
}
function crear_competencia(){
document.getElementById('iMarco').src="CrearCompetencia.php";
}
function concurso_proximo(){
    document.getElementById('iMarco').src="CompetenciaProxima.php";
}
function concurso_actual(){
    document.getElementById('iMarco').src="CompetenciaActual.php";
}
function concurso_anterior(){
    document.getElementById('iMarco').src="CompetenciaAnterior.php";
}

//salir sesion

function salir(){
    document.getElementById('iMarco').src="Salir.php";
}









function FormatoHora(evt,str) 
{ 
var nav4 = window.Event ? true : false; 
var key = nav4 ? evt.which : evt.keyCode; 
hora=str.value 

if(hora.length==0) 
{ 
return ((key >= 48 && key <= 50)); 
} 
if(hora.length==1) 
{ 
if(hora.charAt(0)==2) 
{return ((key >= 48 && key <= 51));} 
else{return ((key >= 48 && key <= 57));} 
} 
if(hora.length==2) 
{ 
return ((key == 58)); 
} 
if(hora.length==3) 
{ 
return ((key >= 48 && key <= 53)); 
} 
if(hora.length==4) 
{ 
return ((key >= 48 && key <= 57)); 
} 
if(hora.length>4) 
{ 
return false; 
} 
} 















var abrirenVentanaNueva = 0;



var tagApartado = 'a';
var docActual = location.href;
function iniciaMenu(menu){
	idMenu = menu
	menu = document.getElementById(menu);
	for(var m = 0; m < menu.getElementsByTagName('ul').length; m++){
		el = menu.getElementsByTagName('ul')[m]
		el.style.display = 'none';
		el.className = 'menuDoc';
		el.parentNode.className = 'cCerrada'
		textoNodo = el.parentNode.firstChild.nodeValue;
		nuevoNodo = document.createElement(tagApartado);
		if(tagApartado == 'a') nuevoNodo.href = '#' + textoNodo;
		nuevoNodo.className = 'tagApartado';
		nuevoNodo.appendChild(document.createTextNode(textoNodo));
		el.parentNode.replaceChild(nuevoNodo,el.parentNode.firstChild);
		nuevoNodo.onclick = function(){
			hijo = sacaPrimerHijo(this.parentNode, 'ul')
			hijo.style.display = hijo.style.display == 'none' ? 'block' : 'none';
			if(this.parentNode.className == 'cCerrada' || this.parentNode.className == 'cAbierta'){
				this.parentNode.className = this.parentNode.className == 'cCerrada' ? 'cAbierta' : 'cCerrada'
			}
			else{
				this.parentNode.className = this.parentNode.className == 'cAbiertaSeleccionada' ? 'cCerradaSeleccionada' : 'cAbiertaSeleccionada' 
			}
			return false;
		}
	}
	documentoActual(idMenu)
}
function sacaPrimerHijo(obj, tag){
	for(var m = 0; m < obj.childNodes.length; m++){
		if(obj.childNodes[m].tagName && obj.childNodes[m].tagName.toLowerCase() == tag){
			return obj.childNodes[m];
			break;
		}
	}
}
function documentoActual(menu){
	idMenu = menu
	menu = document.getElementById(menu);
	for(var s = 0; s < menu.getElementsByTagName('a').length; s++){
		if(abrirenVentanaNueva) menu.getElementsByTagName('a')[s].target = 'blank';
		enlace = menu.getElementsByTagName('a')[s].href
		if(enlace == docActual){
			menu.getElementsByTagName('a')[s].parentNode.className = 'documentoActual'
		}
		if(enlace == docActual && menu.getElementsByTagName('a')[s].parentNode.parentNode.id != idMenu){
			menu.getElementsByTagName('a')[s].parentNode.parentNode.parentNode.className = 'cAbiertaSeleccionada'
			var enlaceCatPadre = sacaPrimerHijo(menu.getElementsByTagName('a')[s].parentNode.parentNode.parentNode, 'a')
			enlaceCatPadre.onclick = function(){
				hijo = sacaPrimerHijo(this.parentNode, 'ul')
				hijo.style.display = hijo.style.display == 'none' ? 'block' : 'none';
				this.parentNode.className = this.parentNode.className == 'cAbiertaSeleccionada' ? 'cCerradaSeleccionada' : 'cAbiertaSeleccionada' 
				return false;

			} 
			nodoSig = sacaPrimerHijo(menu.getElementsByTagName('a')[s].parentNode.parentNode.parentNode, 'ul')
			nodoSig.style.display = 'block';/**/
			abrePadre(idMenu, enlaceCatPadre.parentNode)
		}
	}
}
function abrePadre(idmenu, obj){
	obj.parentNode.parentNode.className = 'cAbiertaSeleccionada'
	var nodoSig = sacaPrimerHijo(obj, 'ul')
	nodoSig.style.display = 'block';
	if(obj.parentNode.id != idmenu){
		abrePadre(idmenu, obj.parentNode.parentNode)
	}
}











































function DateValidator() {

	/* Funcion para calcular la validez de una fecha */
	this.chkdate = function  (objName,sValue) {
		var strDatestyle = "eu"; 
		var strDate;
		var strDateArray;
		var strDay;
		var strMonth;
		var strYear;
		var intday;
		var intMonth;
		var intYear;
		var booFound = false;
		var datefield = objName;
		var strSeparatorArray = new Array("-"," ","/",".");
		var intElementNr;
		var err = 0;
		var strMonthArray = new Array(12);
	
		strMonthArray[0] = "/01/";
		strMonthArray[1] = "/2/";
		strMonthArray[2] = "/3/";
		strMonthArray[3] = "/4/";
		strMonthArray[4] = "/5/";
		strMonthArray[5] = "/6/";
		strMonthArray[6] = "/7/";
		strMonthArray[7] = "/8/";
		strMonthArray[8] = "/9/";
		strMonthArray[9] = "/10/";
		strMonthArray[10] = "/11/";
		strMonthArray[11] = "/12/";
		
		if (datefield!=null) {
			strDate = datefield.value;
		}
		
		if (sValue!= null) {
			strDate = sValue;
		}	
		
		if (strDate.length < 6) {
			return false;
		}
		
		for (intElementNr = 0; intElementNr < strSeparatorArray.length; intElementNr++) {
			if (strDate.indexOf(strSeparatorArray[intElementNr]) != -1) {
				strDateArray = strDate.split(strSeparatorArray[intElementNr]);
				if (strDateArray.length != 3) {
					err = 1;
					return false;
				}
				else {
					strDay = strDateArray[0];
					strMonth = strDateArray[1];
					strYear = strDateArray[2];
				}
				booFound = true;
			}
		}

		if (booFound == false) {
			if (strDate.length>5) {
				strDay = strDate.substr(0, 2);
				strMonth = strDate.substr(2, 2);
				strYear = strDate.substr(4);
			}
		}

		if (strYear.length == 2) {
			strYear = '20' + strYear;
		}

		// US style
		if (strDatestyle == "US") {
			strTemp = strDay;
			strDay = strMonth;
			strMonth = strTemp;
		}
		
		intday = parseInt(strDay, 10);
		if (isNaN(intday)) {
			err = 2;
			return false;
		}
		
		intMonth = parseInt(strMonth, 10);
		if (isNaN(intMonth)) {
			for (i = 0;i<12;i++) {
				if (strMonth.toUpperCase() == strMonthArray[i].toUpperCase()) {
					intMonth = i+1;
					strMonth = strMonthArray[i];
					i = 12;
				}
			}
			if (isNaN(intMonth)) {
				err = 3;
				return false;
			}
		}
		
		intYear = parseInt(strYear, 10);
		if (isNaN(intYear)) {
			err = 4;
			return false;
		}
	
		if (intMonth>12 || intMonth<1) {
			err = 5;
			return false;
		}
	
		if ((intMonth == 1 || intMonth == 3 || intMonth == 5 || intMonth == 7 || intMonth == 8 || intMonth == 10 || intMonth == 12) && (intday > 31 || intday < 1)) {
			err = 6;
			return false;
		}
	
		if ((intMonth == 4 || intMonth == 6 || intMonth == 9 || intMonth == 11) && (intday > 30 || intday < 1)) {
			err = 7;
			return false;
		}

		if (intMonth == 2) {
			if (intday < 1) {
				err = 8;
				return false;
			}
			if (this.LeapYear(intYear) == true) {
				if (intday > 29) {
					err = 9;
					return false;
				}
			}
			else {
				if (intday > 28) {
					err = 10;
					return false;
				}
			}
		}
	
		return true;
	}
	
	/* Año bisiesto */
	this.LeapYear = function  (intYear) {
		if (intYear % 100 == 0) {
			if (intYear % 400 == 0) {return true;}
		}
		else {
			if ((intYear % 4) == 0) {return true;}
		}
		return false;
	}
	
	/* Formato de hora */
	this.chkHora = function  (lahora) {
		var arrHora = (lahora.value).split(":");
		if (arrHora.length!=2) {
			return false;
		}
		if (parseInt(arrHora[0])<0 || parseInt(arrHora[0])>23) {
			return false;
		}
		
		if (parseInt(arrHora[1])<0 || parseInt(arrHora[1])>59) {
			return false;
		}
		return true;
	}
	
}



function CompararHoras(sHora1, sHora2) { 
     
    var arHora1 = hora_inicio.split(":"); 
    var arHora2 = hora_final.split(":"); 
     
    // Obtener horas y minutos (hora 1) 
    var hh1 = parseInt(arHora1[0],10); 
    var mm1 = parseInt(arHora1[1],10); 

    // Obtener horas y minutos (hora 2) 
    var hh2 = parseInt(arHora2[0],10); 
    var mm2 = parseInt(arHora2[1],10); 

    // Comparar 
    if (hh1<hh2 || (hh1==hh2 && mm1<mm2)) 
        return "sHora1 MENOR sHora2"; 
    else if (hh1>hh2 || (hh1==hh2 && mm1>mm2)) 
        return "sHora1 MAYOR sHora2"; 
    else  
        return "sHora1 IGUAL sHora2"; 
} 

function formato(fecha){
    if(fecha<10){
       fecha= "0"+fecha; 
    }
    return fecha;
}

function fechas(){
   var fecha_inicio = document.getElementById('fecha_inicio').value;
   var fecha_final  = document.getElementById('fecha_fin').value;
   var hora_inicio  = document.getElementById('hora_ini').value;
   var hora_final   = document.getElementById('hora_fin').value;
   var valido       = false;
   var f            = new Date();
   
    var arHora1 = hora_inicio.split(":"); 
    var arHora2 = hora_final.split(":"); 
     
    // Obtener horas y minutos (hora 1) 
    var hh1 = parseInt(arHora1[0],10); 
    var mm1 = parseInt(arHora1[1],10); 

    // Obtener horas y minutos (hora 2) 
    var hh2 = parseInt(arHora2[0],10); 
    var mm2 = parseInt(arHora2[1],10); 

   
    if((Date.parse(fecha_final) > Date.parse(fecha_inicio))){
        if( Date.parse(fecha_inicio) >= Date.parse( f.getFullYear() + "-" + (f.getMonth() +1) + "-" + formato(f.getDate()) )) {
            valido=true;
        }
        else{
            alert("Por favor verifique las fechas");
            valido=false;
        }
    }
        
    if( (Date.parse(fecha_final) == Date.parse(fecha_inicio)) ){
        if(Date.parse(fecha_final) >= Date.parse( f.getFullYear() + "-" + (f.getMonth() +1) + "-" + formato(f.getDate()))){
            if ((hh1<hh2 || (hh1==hh2 && mm1<mm2)) && (hh1>f.getHours())){
               valido=true;
             }
            else{
                alert(f.getHours()+"jgjhgjg"+f.getMinutes()+ mm1+ hh1);
                alert("Por favor verifique las Horas");
                valido=false;
            }
        }else{
                alert("Por favor verifique las fechas");
                valido=false;
        }
    }
        
    if(Date.parse(fecha_final) < Date.parse(fecha_inicio)){
        alert("Por favor verifique las fechas, fecha inicio incorrecta");
            valido=false;
    }    
    return valido;
}



function borrar(){

            var d = document.getElementById("resultado");

            while (d.hasChildNodes())

            d.removeChild(d.firstChild);
      
            document.getElementById("cerrar").style.visibility="hidden";
        }