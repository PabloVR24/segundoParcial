<?php
if (class_exists("catalogo_municipio") != true) {
    class catalogo_municipio
    {
        protected $ID_MUNICIPIO;
        protected $NOMBRE_MUNICIPIO;

        public function __construct($id_municipio = null, $nombre_municipio = null)
        {
            $this->ID_MUNICIPIO = $id_municipio;
            $this->NOMBRE_MUNICIPIO = $nombre_municipio;
        }

        public function getID_MUNICIPIO(){
            return $this->ID_MUNICIPIO;
        }
    
        public function setID_MUNICIPIO($ID_MUNICIPIO){
            $this->ID_MUNICIPIO = $ID_MUNICIPIO;
        }
    
        public function getNOMBRE_MUNICIPIO(){
            return $this->NOMBRE_MUNICIPIO;
        }
    
        public function setNOMBRE_MUNICIPIO($NOMBRE_MUNICIPIO){
            $this->NOMBRE_MUNICIPIO = $NOMBRE_MUNICIPIO;
        }
    }
}
