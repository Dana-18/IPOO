<?php
    class Planes {
        //Defino los atributos
        private $codigo;
        private $canales;
        private $importe;
        private $mgDatos;
        
        //Defino el metodo __construct
        public function __construct ($codigo, $canales, $importe) {
            $this -> codigo = $codigo;
            $this -> canales = $canales;
            $this -> importe = $importe;
            $this -> mgDatos = 100;
        }

        //Defino los metodos get y set
        public function getCodigo () {
            return $this -> codigo;
        }
        public function getCanales () {
            return $this -> canales;
        }
        public function getImporte () {
            return $this -> importe;
        }
        public function getMgDatos () {
            return $this -> mgDatos;
        }

        public function setCodigo ($nuevoCodigo) {
            $this -> codigo = $nuevoCodigo;
        }
        public function setCanales ($nuevoCanales) {
            $this -> canales = $nuevoCanales;
        }
        public function setImporte ($nuevoImporte) {
            $this -> importe = $nuevoImporte;
        }
        public function setMgDatos ($nuevoMgDatos) {
            $this -> mgDatos = $nuevoMgDatos;
        }

        //Defino el metodo __toString
        public function __toString () {
            return "El codigo es: " . $this->getCodigo() . "\n" .
            "Los canales son: " . $this->getCanales() . "\n" .
            "El importe es: " . $this->getImporte() . "\n" .
            "Los mg son: " . $this->getMgDatos();
        }

    }    