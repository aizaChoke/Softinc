<?php

class Contenido {
    private $contenedor=array();
    public $pagina;
    function __construct($referencia) {
                    $han = fopen($referencia,"r");
            $this->pagina = fread($han,filesize($referencia));
    }


    function ponerTemplates($clave,$html){
        $this->contenedor[$clave]=$html;
    }
    function ponerContenido($clave,$contenido){
        $this->contenedor[$clave]=$contenido;
    }
    function mostrar(){
        foreach($this->contenedor as $contenido=>$value){
          $nuevo=  str_replace($contenido, $value, $this->pagina);
        }
        return $nuevo;
    }
}

$c =new Contenido("../vista/AgregarArchivos.php");
$c->ponerTemplates("Ingrese","bienvenido al juez");

 echo $c->mostrar();

?>
