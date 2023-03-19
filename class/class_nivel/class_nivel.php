<?php
if (class_exists("catalogo_nivel") != true) {
    class catalogo_nivel
    {
        protected $ID_NIVEL;
        protected $NOMBRE_NIVEL;

        public function __construct($id_nivel = null, $nombre_nivel = null)
        {
            $this->ID_NIVEL = $id_nivel;
            $this->NOMBRE_NIVEL = $nombre_nivel;
        }

        public function getID_NIVEL()
        {
            return $this->ID_NIVEL;
        }

        public function setID_NIVEL($ID_NIVEL)
        {
            $this->ID_NIVEL = $ID_NIVEL;
        }

        public function getNOMBRE_NIVEL()
        {
            return $this->NOMBRE_NIVEL;
        }

        public function setNOMBRE_NIVEL($NOMBRE_NIVEL)
        {
            $this->NOMBRE_NIVEL = $NOMBRE_NIVEL;
        }
    }
}
