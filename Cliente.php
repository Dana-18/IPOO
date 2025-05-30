<?php
    Class Cliente {
        //Defino los atributos
        private $nombreCliente;
        private $apellidoCliente;
        private $tipoDoc;
        private $numDoc;

        //Defino el metodo __construct
        public function __construct($nombreCliente, $apellidoCliente, $tipoDoc, $numDoc) {
            $this->nombreCliente = $nombreCliente;
            $this->apellidoCliente = $apellidoCliente;
            $this->tipoDoc = $tipoDoc;
            $this->numDoc = $numDoc;
        }

        //Defino los get y los set
        public function getNombreCliente() {
            return $this->nombreCliente;
        }
        public function getApellidoCliente() {
            return $this->apellidoCliente;
        }
        public function getTipoDoc() {
            return $this->tipoDoc;
        }
        public function getNumDoc() {
            return $this->numDoc;
        }

        public function setNombreCliente($nuevoNombreCliente) {
            $this->nombreCliente = $nuevoNombreCliente;
        }
        public function setApellido($nuevoApellidoCliente) {
            $this->apellidoCliente = $nuevoApellidoCliente;
        }
        public function setTipoDoc($nuevoTipoDoc) {
            $this->tipoDoc = $nuevoTipoDoc;
        }
        public function setNumDoc($nuevonumDoc) {
            $this->numDoc = $nuevonumDoc;
        }

        //Defino el metodo __toString
        public function __toString() {
            return "Nombre: " . $this->getNombreCliente() . "\n" . 
            "Apellido: " . $this->getApellidoCliente() . "\n" . 
            "Tipo Documento: " . $this->getTipoDoc() . "\n" . 
            "Numero documento: " . $this->getNumDoc() . "\n";
        }
    }