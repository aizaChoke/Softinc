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
{return ((key >= 48 && key <= 51));	} 
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