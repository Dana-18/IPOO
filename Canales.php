<?php
    class Canales {
        //Defino los atributos
        private $tipoCanal;
        private $importe;
        private $hd;

        //Defino el metodo __construct
        public function __construct ($tipoCanales, $importe, $hd) {
            $this -> tipoCanal = $tipoCanal;
            $this -> importe = $importe;
            $this -> hd = $hd;
        }

        //Defino los metodos get y set
        public function getTipoCanal () {
            return $this -> tipoCanal;
        }public function getImporte () {
            return $this -> importe;
        }public function getHd () {
            return $this -> hd;
        }

        public function setTipoCanal ($nuevoTipoCanal) {
            $this -> tipoCanal = $nuevoTipoCanal;
        }
        public function setImporte ($nuevoImporte) {
            $this -> importe = $nuevoImporte;
        }
        public function setHd ($nuevoHd) {
            $this -> hd = $nuevoHd;
        }

        //Defino el metodo __ToString
        public function __toString () {
            return "El tipo de canal es: " . $this->getTipoCanal() . "\n" .
            "El importe es: " . $this->getImporte() . "\n" . 
            "El canal es hd?: " . $this->getHd();
        }
    }