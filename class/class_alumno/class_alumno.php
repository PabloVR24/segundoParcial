<?php
if (class_exists("catalogo_alumno") != true) {
    class catalogo_alumno
    {
        protected $CURP;
        protected $NOMBRE;
        protected $APELLIDO_PAT;
        protected $APELLIDO_MAT;
        protected $TELEFONO;
        protected $CELULAR;
        protected $EMAIL;

        public function __construct($curp = null, $nombre = null, $apellido_pat = null, $apellido_mat = null, $telefono = null, $celular = null, $email = null)
        {
            $this->CURP = $curp;
            $this->NOMBRE = $nombre;
            $this->APELLIDO_PAT = $apellido_pat;
            $this->APELLIDO_MAT = $apellido_mat;
            $this->TELEFONO = $telefono;
            $this->CELULAR = $celular;
            $this->EMAIL = $email;
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
    }
}
