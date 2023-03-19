<?php
if (class_exists("catalogo_ticket") != true) {
    class catalogo_ticket
    {
        protected $ID_TICKET;
        protected $NOMBRE_REALIZA;
        protected $CURP;
        protected $NOMBRE;
        protected $APELLIDO_PAT;
        protected $APELLIDO_MAT;
        protected $TELEFONO;
        protected $CELULAR;
        protected $EMAIL;
        protected $FECHA;
        protected $ID_ASUNTO;
        protected $ID_NIVEL;
        protected $ID_MUNICIPIO;
        protected $ESTATUS;

        public function __construct($id_ticket = null, $nombre_realiza = null, $curp = null, $nombre = null,  $apellido_pat = null, $apellido_mat = null, $telefono = null, $celular = null, $email = null, $fecha = null, $id_asunto = null, $id_nivel = null, $id_municipio = null, $estatus = null)
        {
            $this->ID_TICKET = $id_ticket;
            $this->NOMBRE_REALIZA = $nombre_realiza;
            $this->CURP = $curp;
            $this->NOMBRE = $nombre;
            $this->APELLIDO_PAT = $apellido_pat;
            $this->APELLIDO_MAT = $apellido_mat;
            $this->TELEFONO = $telefono;
            $this->CELULAR = $celular;
            $this->EMAIL = $email;
            $this->FECHA = $fecha;
            $this->ID_ASUNTO = $id_asunto;
            $this->ID_NIVEL = $id_nivel;
            $this->ID_MUNICIPIO = $id_municipio;
            $this->ESTATUS = $estatus;
            
        }

        public function getID_TICKET()
        {
            return $this->ID_TICKET;
        }

        public function setID_TICKET($ID_TICKET)
        {
            $this->ID_TICKET = $ID_TICKET;
        }

        public function getNOMBRE_REALIZA()
        {
            return $this->NOMBRE_REALIZA;
        }

        public function setNOMBRE_REALIZA($NOMBRE_REALIZA)
        {
            $this->NOMBRE_REALIZA = $NOMBRE_REALIZA;
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

        public function getAPELLIDO_PAT()
        {
            return $this->APELLIDO_PAT;
        }

        public function setAPELLIDO_PAT($APELLIDO_PAT)
        {
            $this->APELLIDO_PAT = $APELLIDO_PAT;
        }

        public function getAPELLIDO_MAT()
        {
            return $this->APELLIDO_MAT;
        }

        public function setAPELLIDO_MAT($APELLIDO_MAT)
        {
            $this->APELLIDO_MAT = $APELLIDO_MAT;
        }

        public function getTELEFONO()
        {
            return $this->TELEFONO;
        }

        public function setTELEFONO($TELEFONO)
        {
            $this->TELEFONO = $TELEFONO;
        }

        public function getCELULAR()
        {
            return $this->CELULAR;
        }

        public function setCELULAR($CELULAR)
        {
            $this->CELULAR = $CELULAR;
        }

        public function getEMAIL()
        {
            return $this->EMAIL;
        }

        public function setEMAIL($EMAIL)
        {
            $this->EMAIL = $EMAIL;
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

        public function getESTATUS(){
            return $this->ESTATUS;
        }
    
        public function setESTATUS($ESTATUS){
            $this->ESTATUS = $ESTATUS;
        }
    
        public function getID_MUNICIPIO(){
            return $this->ID_MUNICIPIO;
        }
    
        public function setID_MUNICIPIO($ID_MUNICIPIO){
            $this->ID_MUNICIPIO = $ID_MUNICIPIO;
        }
    
        public function getFECHA(){
            return $this->FECHA;
        }
    
        public function setFECHA($FECHA){
            $this->FECHA = $FECHA;
        }
    }
}
