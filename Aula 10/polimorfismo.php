<?php 
namespace Aula_10;

// Polimorfismo: 
// O termo Polimorfismo significa "várias formas". Associando isso a programação Orientada a objetos,
//O conceito se trata de várias classes  e suas instâncias(objetos) respondendo a um mesmo método de formas diferentes.
//No exemplo do Intrface da Aula 09,temos um método CalcularArea() que responde de forma diferente a classe 
//Quadrado,a classe Pentagono e a classe Circulo.Isso quer dizer que a função é a mesma - calcular a area
//de forma geometrica - mas a operação muda de acordo com a figura.

interface Veiculo {
public function mover();
}

class Carro implements Veiculo{
public $nome;

public function mover() {
echo "O carro ($this->nome) esta andando";
}
}

class Aviao implements Veiculo{
public $nome;

public function mover() {
echo"O avião ($this->nome) está voando";
}
}

$carro1 = new Carro();
$carro->nome = "Civic";

$carro2 = new Carro();
$carro->nome = "Honda";

$carro3 = new Carro();
$carro->nome = "SUV";

$aviao1 = new Aviao();
$aviao->nome = "Boing";

$aviao1 = new Aviao();
$aviao->nome = "Jato";

$aviao1 = new Aviao();
$aviao->nome = "Boing23456";




















?>