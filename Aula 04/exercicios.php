<?php


$carro1 = [
    "marca" => "Honda",
    "modelo" => "Civic",
    "ano" => 2016,
    "revisao" => true,
    "donos" => 2,
];

$carro2 = [
    "marca" => "BMW",
    "modelo" => "320i",
    "ano" => 2012,
    "revisao" => true,
    "donos" => 5,
];

$carro3 = [
    "marca" => "FIAT",
    "modelo" => "uno",
    "ano" => 2005,1,
    "revisao" => false,
    "donos" => 1,
];

$carro4 = [
    "marca" => "Volkswagen",
    "modelo" => "jetta",
    "ano" => 2020,
    "revisao" => true,
    "donos" => 7,
];

//Exercicio 1
function exibirDetalhesCarro($carro) {
    $status_revisao = $carro['revisao'] ? "Sim" : "Não";

    echo "Marca: {$carro['marca']}\n";
    echo "Modelo: {$carro['modelo']}\n";
    echo "Ano: {$carro['ano']}\n";
    echo "Revisão: {$status_revisao}\n";
    echo "Donos: {$carro['donos']}\n";
    echo "\n";
}

//Exercicio 2
function ehSeminovo($ano) {
    $anoAtual = date("Y");
    $idade = $anoAtual - $ano;
    return $idade <= 3;
}

//Exercicio 3
function precisaRevisao($revisao, $ano) {
    if (!$revisao && $ano < 2022) {
        return "Precisa de revisão";
    } else {
        return "Revisão em dia";
    }
}

//Exercicio 4
function calcularValor($marca, $ano, $donos) {
    $anoAtual = date("Y");
    $valorBase = 0;

    switch (strtolower($marca)) {
        case 'BMW':
            $valorBase = 70000;
            break;
        case 'honda':
            $valorBase = 90000;
            break;
        case 'fiat':
            $valorBase = 45000;
            break;
        case 'volkswagen':
            $valorBase = 110000;
            break;
        default:
            $valorBase = 50000;
            break;
    }

    if ($donos > 1) {
        $descontoDonos = ($donos - 1) * 0.05;
        $valorBase *= (1 - $descontoDonos);
    }

    $anosUso = $anoAtual - $ano;
    $valorBase -= $anosUso * 3000;

    if ($valorBase < 0) {
        $valorBase = 0;
    }

    return round($valorBase, 2);
}

function testarFuncoes($carros) {
    foreach ($carros as $carro) {
        echo "---------------------------------------\n";
        exibirDetalhesCarro($carro);
        
        $ehSeminovo = ehSeminovo($carro['ano']) ? "Sim" : "Não";
        $statusRevisao = precisaRevisao($carro['revisao'], $carro['ano']);
        $valorEstimado = calcularValor($carro['marca'], $carro['ano'], $carro['donos']);
        
        printf("É seminovo? %s\n", $ehSeminovo);
        printf("Status da revisão: %s\n", $statusRevisao);
        printf("Valor estimado: R$ %s\n\n", number_format($valorEstimado, 2, ',', '.'));
    }
    echo "---------------------------------------\n";
}


$meusCarros = [$carro1, $carro2, $carro3, $carro4];
testarFuncoes($meusCarros);

?>