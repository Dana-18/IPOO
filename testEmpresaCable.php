<?php

    include_once "Canal.php";
    include_once "Cliente.php";
    include_once "Contrato.php";
    include_once "ContratoWeb.php";
    include_once "EmpresaCable.php";
    include_once "Planes.php";

    $empresa = new EmpresaCable();

    $canal1 = new Canal("infantil", 1000, false);
    $canal2 = new Canal("peliculas", 12000, false);
    $canal3 = new Canal("musical", 13000, true);

    $plan1 = new Planes(131, [$canal1, $canal2], 25000, true);
    $plan2 = new Planes(111, [$canal1, $canal2, $canal3], 60000, false);

    $cliente = new Cliente("Dana", "garcia", "dni", "45719193");

    $contrato1 = new Contrato(date('Y-m-d'), '2025-06-13', $cliente, $plan1);
    $contrato2 = new ContratoWeb(date('Y-m-d'), '2025-09-16', $cliente, $plan2);
    $contrato3 = new ContratoWeb(date('Y-m-d'), '2025-10-15', $cliente, $plan1);

    echo $contrato1->calcularImporte() . "\n";
    echo $contrato2->calcularImporte() . "\n";
    echo $contrato3->calcularImporte() . "\n";

    $empresa->incorporarPlan($plan1);
    $empresa->incorporarPlan($plan2);

    $empresa->incorporarContrato($plan1, $cliente, date('Y-m-d') ,'2025-06-13', false);

    $empresa->incorporarContrato($plan2, $cliente, date('Y-m-d'), '2025-05-02', true);

    $empresa->pagarContrato($contrato1);

    $empresa->pagarContrato($contrato3);

    $empresa->retornarPromImporteContratos(111);