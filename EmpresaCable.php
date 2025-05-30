<?php 
    class EmpresaCable {
        //Defino los atributos 
        private $objPlan;
        private $objCanal;
        private $objClientes;
        private $objContratos;

        //Defino el metodo __construct
        public function __construct ($objPlan, $objCanal, $objClientes, $objContratos) {
            $this -> objPlan = $objPlan;
            $this -> objCanal = $objCanal;
            $this -> objClientes = $objClientes;
            $this -> objContratos = $objContratos;
        }

        //Defino los metodos get y set
        public function getObjPlan () {
            return $this -> objPlan ;
        }
        public function getObjCanal () {
            return $this -> objCanal;
        }
        public function getObjClientes () {
            return $this -> objClientes;
        }
        public function getObjContratos () {
            return $this -> objContratos;
        }

        public function setObjPlan ($nuevoObjPlan) {
            $this -> objPlan = $nuevoObjPlan;
        }
        public function setObjCanal ($nuevoObjCanal) {
            $this -> objCanal = $nuevoObjCanal;
        }
        public function setObjClientes ($nuevoObjClientes) {
            $this -> objClientes = $nuevoObjClientes;
        }
        public function setObjContratos ($nuevoObjContratos) {
            $this -> objContratos = $nuevoObjContratos;
        }

        //Defino el metodo __toString
        public function __toString () {
            return "El objeto plan es: " . $this->getObjPlan() . "\n" . 
            "El objeto canal es: " . $this->getObjCanal() . "\n" . 
            "El objeto clientes es: " . $this->getObjClientes() . "\n" . 
            "El objeto contratos es: " . $this->getObjContratos();
        }

        //Defino el metodo incorporarPlan 
        public function incorporarPlan($objPlan) {
            $planesActuales = $this->getObjPlan();
            $canalesPlanNuevo = $objPlan->getCanales();
            $resultado = true;
            $megasPlanNuevo = $objPlan->getMgDatos();
            foreach ($planesActuales as $plan) {
                $canalesExistentes = [];
                foreach ($plan->getCanales() as $canal) {
                    $canalesExistentes[] = $canal->getTipoCanal();
                }
                sort ($canalesExistentes);

                $mgExistente = $plan->getMgDatos() ? "true" : "false";

                if ($mgExistente == true) {
                    $megasExistente = $plan->getMgDatos();
                }

                if ($canalesPlanNuevo == $canalesExistentes && $megasPlanNuevo == $megasExistente) {
                    $resultado = false;
                }
            }
            array_push($planesActuales, $objPlan);
            $this->setObjPlanes($planesActuales);
            return $resultado;
        }

        //Defino el metodo buscarContrato
        public function buscarContrato($tipoDoc, $numDoc) {
            $ContratosActuales = $this->getObjContratos();
            $contratoCliente = null;
            foreach ($ContratosActuales as $contrato) {
                $tipoDocContrato = $contrato->getObjClientes()->getTipoDoc();
                $numDocContrato = $contrato->getObjClientes()->getNumDoc();
                if ($tipodocContrato == $tipoDoc && $numDoc == $numDocContrato) {
                    $contratoCliente = $contrato;
                }
            }
            return $contratoCliente;
        }

        //Defino el metodo incorporarContrato
        public function incorporarContrato($objPlan, $refCliente, $fechaInicio, $fechaVencimiento, $contratoWeb) {
            $planEncontrado = false;
            $tipoDocCliente = $refCliente->getTipoDoc();
            $numDocCliente = $refCliente->getNumDoc();
            $ContratosActuales = $this->getObjContratos();
            $nuevaColContratos = [];
            foreach ($ContratosActuales as $contrato) {
                $docContrato = $contrato->getObjClientes()->getTipoDoc();
                $numDocContrato = $contrato->getObjClientes()->getNumDoc();

                if ($tipoDocCliente != $docContrato && $numDocContrato != $numDocCliente) {
                    array_push($nuevaColContratos, $contrato);
                }
            }
            $this->setObjContratos($nuevaColContratos);
            if ($contratoWeb) {
                $nuevoContrato = new ContratoWeb($fechaInicio, $fechaVencimiento, $refCliente, $objPlan);
            } else {
                $nuevoContrato = new Contrato($fechaInicio, $fechaVencimiento, $refCliente, $objPlan);
            }
        }

        //Defino el metodo retornarPromImporteContratos
        public function retornarPromImporteContratos($codigoPlan) {
            $contratosActuales = $this->getObjContratos();
            $cantContratos = 0;
            $contratosTotales = 0;
            $promedio = 0;

            foreach ($contratosActuales as $contrato) {
                $codigoContrato = $contrato->getObjPlan()->getCodigo();

                if ($codigoPlan == $codigoContrato) {
                    $cantContratos += 1;
                    $contratosTotales += $contrato->calcularImporte();
                }
            }
            $promedio = $contratosTotales / $cantContratos;
            return $promedio;
        }

        //Defino el metodo pagarContrato 
        public function pagarContrato($codContrato) {
            $contratosActuales = $this->getObjContratos();
            $contratoEncontrado = [];
            $totalAPagar = 0;
            foreach ($contratosActuales as $contrato) {
                $idContrato = $contrato->getIDContrato();

                if ($idContrato == $codContrato) {
                    $importeFinal = $contrato->calcularImporte();
                    $contratoEncontrado[] = $contrato;
                }
            }
            $contratoEncontrado->actualizarEstadoContrato();
            $estadoDelContrato = $contratoEncontrado->getEstado();
            $diasVencido = $contratoEncontrado->diasContratoVencido($contratoEncontrado);
            if ($estadoDelContrato == "al dia") {
                $estadoDelContrato->setRenovacion(true);
                $totalAPagar = $importeFinal;
            } else if ($estadoDelContrato == "moroso") {
                $estadoDelContrato->setEstado("al dia");
                $estadoDelContrato->setRenovacion(true);
                $totalAPagar = $importeFinal + (($importeFinal * 0.10) * $diasVencido);
            } else if ($estadoDelContrato == "suspendido") {
                $estadoDelContrato->setRenovacion(false);
                $totalAPagar = $importeFinal + (($importeFinal * 0.10) * $diasVencido);
            } else if ($estadoDelContrato == "finalizado") {
                $totalAPagar = 0;
                $estadoDelContrato->setRenovacion(false);
            }
            return $totalAPagar;
        }

    }

    