<?php 
//Classe->Substantivos e Métodos->Verbos

//Classes:Turistas
//Subclasses:Brasil,Japão e Acre.

//Métodos:Comer comidadas típicas e nadar em rios ou praias.

class Turistas{
private $local;
private $comida;
private $lazer;

public function __construct($local,$comida,$lazer)  {
$this->setLocal($local);
$this->setComida($comida);
$this->setLazer($lazer);
}

public function setLocal($local) {
$this->local = $local;
}

public function getLocal() {
return $this->local;
}
public function setComida($comida) {
$this->comida = $comida;
}

public function getComida() {
return $this->comida;
}
public function setLazer($lazer) {
$this->lazer = $lazer;

}

public function getLazer() {
$this->lazer;
}


}

?>