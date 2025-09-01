<?php 
//Exercicio 1
class Carro {
private $Marca;
private $Modelo;

function __construct($Marca, $Modelo) {
$this->setMarca($Marca);
$this->setModelo($Modelo);
}

public function setMarca($Marca) {
$this->Marca = $Marca;
}

public function getMarca() {
return $this->Marca;
}

public function setModelo($Modelo) {
$this->Modelo = $Modelo;
}

public function getModelo() {
return $this->Modelo;
}

public function informacao() {
return "Marca: " . $this->getMarca() . "\nModelo: " . $this->getModelo();
}
}

$carro = new Carro("BYD", "SUV Song Plus");

echo $carro->informacao();
?>