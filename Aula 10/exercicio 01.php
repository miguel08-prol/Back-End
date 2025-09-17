<?php 
namespace Aula_10;
interface Forma {
    public function calcularArea($valor1, $valor2 = null);
}

class Quadrado implements Forma {
    public function calcularArea($valor1, $valor2 = null) {
        $lado = $valor1;
        return $lado * $lado;
    }
}

class Circulo implements Forma {
    public function calcularArea($valor1, $valor2 = null) {
        $diametro = $valor1;
        $raio = $diametro / 2;
        return 3.14 * ($raio * $raio);
    }
}

$quadrado = new Quadrado();
$areaQuadrado = $quadrado->calcularArea(5);
echo "A área do quadrado é: " . $areaQuadrado . "\n";

$circulo = new Circulo();
$areaCirculo = $circulo->calcularArea(24);
echo "A área do círculo é: " . $areaCirculo . "\n";
?>
