<?php 
    class ContratoWeb extends Contrato {
        //Defino los atributos 
        private $porcentajeDesc;

        //Defino el metodo __construct
        public function __construct ($fechaInicio, $fechaVencimiento, $plan, $estadoPlan, $costo, $renovacion, $objCliente, $porcentajeDesc) {
            parent::__construct ($porcentajeDesc);
            $this -> porcentajeDesc = $porcentajeDesc;
        }

        //Defino el get y el set
        public function getPorcentajeDesc () {
            return $this -> porcentajeDesc;
        }

        public function setPorcentajeDesc ($nuevoPorcentajeDesc) {
            $this -> porcentajDesc = $nuevoPorcentajeDesc;
        }

        //Defino el metodo __toString
        public function __toString () {
            $cadena = parent::_toString();
            $cadena .= "El porcentaje de descuento es de: " . $this->getPorcentajeDesc();
        }

        //Redefino el metodo calcularImporte
        public function calcularImporte () {
            $costoBase = parent::calcularImporte();
            $descuento = $this->getPorcentajeDesc();
            $costoFinal -= ($costoFinal / 100 * $descuento);
            return $costoFinal; 
        }
    }