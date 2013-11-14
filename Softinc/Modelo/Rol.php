<?php

class Rol {
    
    private $idRol;
    private $nombreRol;
    
    public function getIdRol() {
        
        return $this->idRol;
    }
    
    public function setRol($id) {
        
        $this->idRol = $id;
    }
    
    public function getNombre() {
        
        return $this->nombreRol;
    }
    
    public function setNombre($nombre){
        
        $this->nombreRol = $nombre;
    }
}
?>
