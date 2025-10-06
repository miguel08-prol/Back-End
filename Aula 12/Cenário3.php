<?php 
//Classes:Personagem
//Métodos:Chover(),Amar(),Superar(),Comer()
//objetos:$grupo1,$grupo2
//A classe Personagem se relaciona com nome

class Personagem {
private $nome;

public function __construct($nome) {
$this->setNome($nome);
}

public function setNome($nome) {
$this->nome = $nome;
}

public function getNome() {
return $this->nome;
}

public function Chover() {
echo "\n".$this->nome.": E agora!!Começou a chover\n";
}

public function Amar() {
echo $this->nome.": Vamos ficar juntos!!\n";
}

public function Superar() {
echo $this->nome.": AEE!!Superamos o medo\n";
}

public function Comer() {
echo $this->nome.": Vamos comer um lanche para celebrar!!\n";
}
}

$grupo1 = new Personagem("Deadpool,Homem-Aranha");
echo $grupo1->Chover();
echo $grupo1->Amar();
echo $grupo1->Superar();
echo $grupo1->Comer();

$grupo2 = new Personagem("Deadpool,Homem-Aranha,Lanterna-Rosa");
echo $grupo2->Chover();
echo $grupo2->Amar();
echo $grupo2->Superar();
echo $grupo2->Comer();

?>














