<?php 
namespace Aula_10;

interface Transporte {
public function mover();
}

class Carro implements Transporte{
public $nome;

public function mover() {
echo "O carro ($this->nome) esta andando na estrada";
}
}

class Aviao implements Transporte{
public $nome;

public function mover() {
echo"O avião ($this->nome) está voando no céu";
}
}

class Barco implements Transporte {
public $nome;

public function mover() {
echo "O barco ($this->nome) está navegando no mar";
}
}

class Elevador implements Transporte {
public $nome;

public function mover() {
echo "O elevador ($this->nome) está correndo pelo prédio";
}

}

$carro1 = new Carro();
$carro->nome = "Civic";

$barco1 = new Barco();
$barco->nome = "Titanic";

$aviao1 = new Aviao();
$aviao->nome = "Jato";

$elevador1 = new Elevador();
$elevador->nome = "Supremo";
