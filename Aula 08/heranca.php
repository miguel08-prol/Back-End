<?php 
class Animal{
private $Especie;
private $Habitat;
private $Sexo;
private $Alimentacao;

public function __construct($Especie,$Habitat,$Sexo,$Alimentacao) {
$this->setEspecie($Especie);
$this->setHabitat($Habitat);
$this->setSexo($Sexo);
$this->setAlimentacao($Alimentacao);
}

public function getEspecie() {
return $this->Especie;
}

public function setEspecie($Especie) {
$this->Especie = $Especie;
}

public function getHabitat() {
return $this->Habitat;
}

public function setHabitat($Habitat) {
$this->Habitat = $Habitat;
}

public function getSexo() {
return $this->Sexo;
}

public function setSexo($Sexo) {
$this->Sexo = $Sexo;
}

public function getAlimentacao() {
return $this->Alimentacao;
}

public function setAlimentacao($Alimentacao) {
$this->Alimentacao = $Alimentacao;
}
}
//Extends=Subclasses
class Cachorro extends Animal{
private $Raca;
public function __construct($Especie,$Habitat,$Sexo,$Alimentacao,$Raca) {
parent::__construct($Especie,$Habitat,$Sexo,$Alimentacao);
$this->setRaca($Raca);
}

public function getRaca() {
return $this->Raca;
}

public function setRaca($Raca) {
$this->Raca = $Raca;
}
}


class Pangolin extends Animal{
private $N°Escamas;

public function __construct($Especie, $Habitat, $Sexo, $Alimentacao,$N°Escamas) {
parent::__construct($Especie, $Habitat, $Sexo, $Alimentacao);

$this->N°Escamas = $N°Escamas;
}}

class Macaco extends Animal {
private $tempo_dormindo;
private $qtde_bananas_comidas;

public function __construct($Especie, $Habitat, $Sexo, $Alimentacao,$tempo_dormindo,$qtde_bananas_comidas) {
parent::__construct($Especie, $Habitat, $Sexo, $Alimentacao);
$this->tempo_dormindo = $tempo_dormindo;
$this->qtde_bananas_comidas = $qtde_bananas_comidas;
}
}

class gato extends Animal {
private $tipo_ronronamento;
public function __construct($Especie, $Habitat, $Sexo, $Alimentacao,$tipo_ronronamento) {
parent::__construct($Especie, $Habitat, $Sexo, $Alimentacao);
$this->tipo_ronronamento = $tipo_ronronamento;
}
};

?>