<?php
    class Contrato {
        //Defino los atributos
        private $fechaInicio;
        private $fechaVencimiento;
        private $objPlan;
        private $estadoPlan;
        private $costo;
        private $renovacion;
        private $objCliente;

        //defino el metodo __construct 
        public function __construct ($fechaInicio, $fechaVencimiento, $objCliente, $objPlan ) {
            $this -> fechaInicio = $fechaInicio;
            $this -> fechaVencimiento = $fechaVencimiento;
            $this -> objPlan = $objPlan;
            $this -> estadoPlan = "al dia";
            $this -> costo = 0;
            $this -> renovacion = true;
            $this -> objCliente = $objCliente;
        }

        //Defino los metodos get y set
        public function getFechaInicio () {
            return $this -> fechaInicio;
        }
        public function getFechaVencimiento () {
            return $this -> fechaVencimiento;
        }
        public function getObjPlan () {
            return $this -> objPlan;
        }
        public function getEstadoPlan () {
            return $this -> estadoPlan;
        }
        public function getCosto () {
            return $this -> costo;
        }
        public function getRenovacion () {
            return $this -> renovacion;
        }
        public function getObjCliente () {
            return $this -> objCliente;
        }

        public function setFechaInicio ($nuevoFechaInicio) {
            $this -> fechaInicio = $nuevoFechaInicio;
        }
        public function setFechaVencimiento ($nuevoFechaVencimiento) {
            $this -> fechaVencimiento = $nuevoFechaVencimiento;
        }
        public function setObjPlan ($nuevoObjPlan) {
            $this -> objPlan = $nuevoObjPlan;
        }
        public function setEstadoPlan ($nuevoEstadoPlan) {
            $this -> estadoPlan = $nuevoEstadoPlan;
        }
        public function setCosto ($nuevoCosto) {
            $this -> costo = $nuevoCosto;
        }
        public function setRenovacion ($nuevoRenovacion) {
            $this -> renovacion = $nuevoRenovacion;
        }
        public function setObjCliente ($nuevoObjCliente) {
            $this -> objCliente = $nuevoObjCliente;
        }

        //Defino el metodo __toString
        public function __toString () {
            return "La fecha de inicio es: " . $this->getFechaInicio() . "\n" . 
            "La fecha de vencimiento es: " . $this->getFechaVencimiento() . "\n" . 
            "El plan es: " . $this->getObjPlan() . "\n" . 
            "El estado del plan es: " . $this->getEstadoPlan() . "\n" . 
            "El costo es: " . $this->getCosto() . "\n" . 
            "La renovacion es: " . $this->getRenovacion() . "\n" . 
            "El objCliente es: " . $this->getObjCliente();
        }

        //Defino el metodo diasContratoVencido
        public function diasContratoVencido($objContrato) {
            $fechaActual = new DateTime();
            $contratoVencido = $objContrato->getFechaVencimiento();
            $diferencia = $contratoVencido->diff($fechaActual);
            $diasVencidos = 0;

            if ($diferencia->invert == 1 || $diferencia->days == 0 ) {
                $diasVencidos = 0;
            } else {
                $diasVencidos = $diferencia->days;
            }

            return $diasVencidos;
        }

        //Defino el metodo actualizarEstadoContrato
        public function actualizarEstadoContrato() {
            $diasVencidos = $this->diasContratoVencido($this);
            if ($diasVencidos > 0) {
                $this->setEstadoPlan("moroso");
                if ($diasVencidos > 10) {
                    $this->setEstadoPlan("suspendido");
                }
            } else {
                $this->setEstadoPlan("al dia");
            }
        }

        //Defino el metodo calcularImporte
        public function calcularImporte () {
            $costoTotal = 0;
            $objPlan = $this->getObjPlan();
            $planCanales = $objPlan->getCanales();
            $costoPlan = $objPlan->getImporte();
            foreach ($planCanales as $canal) {
                $costoTotal += $canal->getImporte();
            }
            $costoFinal = $costoTotal + $costoPlan;
            return $costoFinal;
        }

    }
