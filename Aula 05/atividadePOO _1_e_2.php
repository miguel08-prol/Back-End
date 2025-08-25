<?php
//Exercicio 1:Crie uma classe (mode de objetos) chamado "Cachorro" com os seguintes atributos:Nome,raça,castrado e sexo.

class Cachorro {
public $Nome;
public $Raça;
public $Castrado;
public $Sexo;

public function __construct($Nome,$Raça,$Castrado,$Sexo){
$this->Nome = $Nome;
$this->Raça = $Raça;
$this->Castrado = $Castrado;
$this->Sexo = $Sexo;
}

public function latir() {
echo "O cachorro $this->Nome está latindo!";
}

public function marcar_território() {
echo "O cachorro $this->Nome da raça $this->Raça está marcando território";
}
};
//Exercicio 2
$Cachorro1 = new Cachorro("Queijo","Lavrador",true,"M");

$Cachorro2 = new Cachorro("Rex","Pincher", false,"M");

$Cachorro3 = new Cachorro("Vitória","Husky", false,"F");

$Cachorro4 = new Cachorro("Morango","Pastor_alemão",true,"F");

$Cachorro5 = new Cachorro("Zeus","Salsichinha",true,"M");

$Cachorro6 = new Cachorro("Thor","Vira_lata", true,"M");

$Cachorro7 = new Cachorro("Flor", "Rotviller",false,"F");

$Cachorro8 = new Cachorro("Mortandela","buldogue",true,"F");

$Cachorro9 = new Cachorro("Max","Poodle",true,"M");

$Cachorro10 = new Cachorro("Luna","Beagle",False,"F");

$Cachorro1 ->latir();
$Cachorro2 ->marcar_território();