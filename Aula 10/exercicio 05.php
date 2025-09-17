<?php 
namespace Aula_10;

class Calculadora{

public function somar(float ...$numeros) {
$soma = 0;
foreach ($numeros as $numero) {
$soma += $numero;
}
return $soma;
}
}
 
$calculadora = new Calculadora();
$resultado1 = $calculadora->somar(5,45);
echo "A soma é: ". $resultado1 . "<br>;";

$resultado2 = $calculadora->somar(5,45,87);
echo "A soma é: ". $resultado2 . "<br>";
?>