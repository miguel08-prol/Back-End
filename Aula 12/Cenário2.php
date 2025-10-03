<?php 
//Classes:Personagens,Lugar 
//Subclasse:Lugar.


//Métodos:Fazer,doar

class Personagem {
private $nome;
private $dinheiro;

public function __construct($nome,$dinheiro) {
$this->setNome($nome);
$this->setDinheiro($dinheiro);
}

public function setNome($nome) {
$this->nome = $nome;
}

public function getNome() {
return $this->nome;
}

public function setDinheiro($dinheiro) {
$this->dinheiro = $dinheiro;
}

public function getDinheiro() {
return $this->dinheiro;
}
}

class Lugar extends Personagem {
private 
}


?>