<?php
if (class_exists("catalogo_usuario") != true) {
    class catalogo_usuario
    {
        protected $NOMBRE_USUARIO;
        protected $NOMBRE;
        protected $CONTRASEÑA;

        public function __construct($nombre_usuario = null, $nombre = null, $contraseña = null)
        {
            $this->NOMBRE_USUARIO = $nombre_usuario;
            $this->NOMBRE = $nombre;
            $this->CONTRASEÑA = $contraseña;
        }

        public function getNOMBRE_USUARIO(){
            return $this->NOMBRE_USUARIO;
        }
    
        public function setNOMBRE_USUARIO($NOMBRE_USUARIO){
            $this->NOMBRE_USUARIO = $NOMBRE_USUARIO;
        }
    
        public function getNOMBRE(){
            return $this->NOMBRE;
        }
    
        public function setNOMBRE($NOMBRE){
            $this->NOMBRE = $NOMBRE;
        }
    
        public function getCONTRASEÑA(){
            return $this->CONTRASEÑA;
        }
    
        public function setCONTRASEÑA($CONTRASEÑA){
            $this->CONTRASEÑA = $CONTRASEÑA;
        }

    }
}
