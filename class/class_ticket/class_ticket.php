<?php
if (class_exists("catalogo_ticket") != true) {
    class catalogo_ticket
    {
        protected $ID_TICKET;
        protected $NOMBRE_USUARIO;
        protected $CURP;
        protected $NOMBRE;
        protected $FECHA;
        protected $ID_ASUNTO;
        protected $ID_NIVEL;
        protected $ID_MUNICIPIO;
        protected $ESTATUS;
        protected $TURNO;

        public function __construct($id_ticket = null, $nombre_usuario = null, $curp = null, $fecha = null, $id_asunto = null, $id_nivel = null, $id_municipio = null, $estatus = null, $turno = null)
        {
            $this->ID_TICKET = $id_ticket;
            $this->NOMBRE_USUARIO = $nombre_usuario;
            $this->CURP = $curp;
            $this->FECHA = $fecha;
            $this->ID_ASUNTO = $id_asunto;
            $this->ID_NIVEL = $id_nivel;
            $this->ID_MUNICIPIO = $id_municipio;
            $this->ESTATUS = $estatus;
            $this->TURNO = $turno;
        }

        public function getID_TICKET()
        {
            return $this->ID_TICKET;
        }

        public function setID_TICKET($ID_TICKET)
        {
            $this->ID_TICKET = $ID_TICKET;
        }

        public function getNOMBRE_USUARIO()
        {
            return $this->NOMBRE_USUARIO;
        }

        public function setNOMBRE_USUARIO($NOMBRE_USUARIO)
        {
            $this->NOMBRE_USUARIO = $NOMBRE_USUARIO;
        }

        public function getCURP()
        {
            return $this->CURP;
        }

        public function setCURP($CURP)
        {
            $this->CURP = $CURP;
        }

        public function getNOMBRE()
        {
            return $this->NOMBRE;
        }

        public function setNOMBRE($NOMBRE)
        {
            $this->NOMBRE = $NOMBRE;
        }



        public function getID_ASUNTO()
        {
            return $this->ID_ASUNTO;
        }

        public function setID_ASUNTO($ID_ASUNTO)
        {
            $this->ID_ASUNTO = $ID_ASUNTO;
        }

        public function getID_NIVEL()
        {
            return $this->ID_NIVEL;
        }

        public function setID_NIVEL($ID_NIVEL)
        {
            $this->ID_NIVEL = $ID_NIVEL;
        }

        public function getESTATUS()
        {
            return $this->ESTATUS;
        }

        public function setESTATUS($ESTATUS)
        {
            $this->ESTATUS = $ESTATUS;
        }

        public function getID_MUNICIPIO()
        {
            return $this->ID_MUNICIPIO;
        }

        public function setID_MUNICIPIO($ID_MUNICIPIO)
        {
            $this->ID_MUNICIPIO = $ID_MUNICIPIO;
        }

        public function getFECHA()
        {
            return $this->FECHA;
        }

        public function setFECHA($FECHA)
        {
            $this->FECHA = $FECHA;
        }

        public function getTURNO()
        {
            return $this->TURNO;
        }

        public function setTurno($TURNO)
        {
            $this->TURNO = $TURNO;
        }
    }
}
