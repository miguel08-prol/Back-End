<?php

$marca_carro1 = "Honda";
$modelo_carro1 = "Civic";
$ano_carro1 = 2016; 
$revisao_carro1 = true;
$donos_carro1 = 2;



function exibirDetalhesCarro($marca, $modelo, $ano, $revisao, $donos) {

$status_revisao = $revisao ? "Sim" : "Não";

echo "Marca: " . $marca . "\n";
echo "Modelo: " . $modelo . "\n";
echo "Ano: " . $ano . "\n";
echo "Revisão: " . $status_revisao . "\n";
echo "Donos: " . $donos . "\n";
echo "\n";
}

exibirDetalhesCarro($marca_carro1, $modelo_carro1, $ano_carro1, $revisao_carro1, $donos_carro1);

// Função do exercício 2
function ehSeminovo($ano) {
    $anoAtual = date("Y");
    $idade = $anoAtual - $ano;
    return $idade <= 3;
    
}

// Função do exercício 3
function precisaRevisao($revisao, $ano) {
    if (!$revisao && $ano < 2022) {
        return "Precisa de revisão";
    } else {
        return "Revisão em dia";
    }
}

// Função do exercício 4
function calcularValor($marca, $ano, $Ndonos) {
    $anoAtual = date("Y");
    $valorBase = 0;

    switch (strtolower($marca)) {
        case 'bmw':
        case 'porsche':
            $valorBase = 300000;
            break;
        case 'nissan':
            $valorBase = 70000;
            break;
        case 'byd':
            $valorBase = 150000;
            break;
        default:
            $valorBase = 50000; 
            break;
    }

    if ($Ndonos > 1) {
        $descontoDonos = ($Ndonos - 1) * 0.05;
        $valorBase *= (1 - $descontoDonos);
    }

    $anosUso = $anoAtual - $ano;
    $valorBase -= $anosUso * 3000;

    if ($valorBase < 0) {
        $valorBase = 0;
    }

    return round($valorBase, 2);
}


function testarFuncoes() {
    $carros = [
        ['marca' => 'BMW', 'ano' => 2022, 'Ndonos' => 1, 'revisao' => true],
        ['marca' => 'Nissan', 'ano' => 2020, 'Ndonos' => 2, 'revisao' => false],
        ['marca' => 'BYD', 'ano' => 2019, 'Ndonos' => 3, 'revisao' => false],
        ['marca' => 'Porsche', 'ano' => 2021, 'Ndonos' => 1, 'revisao' => true],
        ['marca' => 'Fiat', 'ano' => 2018, 'Ndonos' => 4, 'revisao' => false],
    ];

    foreach ($carros as $carro) {
        echo "Marca: {$carro['marca']}, Ano: {$carro['ano']}, Donos: {$carro['Ndonos']}\n";
        echo "É seminovo? " . (ehSeminovo($carro['ano']) ? "Sim" : "Não") . "\n";
        echo "Status da revisão: " . precisaRevisao($carro['revisao'], $carro['ano']) . "\n";
        echo "Valor estimado: R$ " . number_format(calcularValor($carro['marca'], $carro['ano'], $carro['Ndonos']), 2, ',', '.') . "\n";
        echo "---------------------------------------\n";
    }
}


testarFuncoes();

?>
