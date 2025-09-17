<?php 
namespace Aula_10;

interface Movel {
public function mover();
}

interface Abastecivel{
public function abastecer($quantidade);
}

interface Manutenivel {
public function manutencao();
}

class Carro implements Movel,Abastecivel {
public $quantidade;

public function mover() {
echo "O carro está se movimentando";
}
public function abastecer($quantidade) {
echo "O carro foi abastecido com ($this->quantidade) litros de combustivel";
}
}

class Bicicleta implements Movel,Manutenivel{
public $modelo;

public function mover() {
echo "A bicicleta do modelo ($this->modelo) está pedalando";
}
public function manutencao() {
echo "O modelo ($this->modelo) foi lubrificada";
}
}

class Onibus implements Movel,Abastecivel,Manutenivel{
public $quantidade;

public function mover() {
echo "O onibus está transportando passageiros";
}

public function abastecer($quantidade) {
echo "O onibus foi abastecido com ($this->quantidade) litros de combustivel";
}

public function manutencao() {
echo "O onibus está passando por revisão";
}
}

$carro1 = new Carro();
$carro1->mover();
$carro1->abastecer(6);


$bicicleta1 = new Bicicleta();
$bicicleta1->modelo = "BICICLETA ARO 29 RINO";
$bicicleta1->mover();
$bicicleta1->manutencao();

$onibus1 = new Onibus();
$onibus1->mover();
$onibus1->abastecer(78);
$onibus1->manutencao();

?>