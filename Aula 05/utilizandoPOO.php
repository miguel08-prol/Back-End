<?php 
class Carro {//Criando classe (molde para criação de objetos )
// usar public para criar atributos na classe
 public $marca; 
 public $modelo;
 public $ano; 
 public $revisao;
 public $n_donos;

 //Criando contrutor da classe,para associação dos atributos corretamente de cada objeto.
function __construct($marca,$modelo,$ano,$revisao,$n_donos) {
//usar this(esse em portugues) para ele saber o que tem que puxar
$this->marca = $marca;
$this->modelo = $modelo;
$this->ano = $ano;  
$this->revisao = $revisao;
$this->n_donos = $n_donos;
 }    
}
//Criando objetos
$carro1 = new Carro("Porsche","911", 2020, false, "3");

$carro2 = new Carro("Mitsubishi","lancer",1945,true,"1");

$carro3 = new Carro("Fiat","Uno",2012,true,4);

$carro4 = new Carro("BMW ","320i",2016,false,2);

$carro5 = new Carro("Honda","Civic",2016,true,5);

$carro6 = new Carro("volkswagen","Jetta",2020,true,7);

?>