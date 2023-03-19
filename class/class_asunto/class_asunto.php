<?php
if (class_exists("catalogo_asunto") != true) {
    class catalogo_asunto
    {
        protected $ID_ASUNTO;
        protected $NOMBRE_ASUNTO;

        public function __construct($id_asunto = null, $nombre_asunto = null)
        {
            $this->ID_ASUNTO = $id_asunto;
            $this->NOMBRE_ASUNTO = $nombre_asunto;
        }

        public function getID_ASUNTO()
        {
            return $this->ID_ASUNTO;
        }

        public function setID_ASUNTO($ID_ASUNTO)
        {
            $this->ID_ASUNTO = $ID_ASUNTO;
        }

        public function getNOMBRE_ASUNTO()
        {
            return $this->NOMBRE_ASUNTO;
        }

        public function setNOMBRE_ASUNTO($NOMBRE_ASUNTO)
        {
            $this->NOMBRE_ASUNTO = $NOMBRE_ASUNTO;
        }
    }
}
