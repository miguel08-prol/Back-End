<?php 
//Classes:Pessoas
//Métodos:engravidar(),nascer(),crescer(),fazerEscolha(),doar()
//objetos:$pessoa1,$pessoa2

class Pessoas {
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

public function engravidar() {
echo "\n".$this->nome.": Engravidou de Davi\n";
}

public function crescer() {
echo $this->nome.": nasceu da mãe dela\n";
}

public function fazerEscolha() {
echo $this->nome.": escolheu mora numa mansão\n";
}

public function doar() {
echo $this->nome.": resolveu doar para pessoas necessitadas\n";
}

}


$pessoa1 = new Pessoas("Ana");
echo $pessoa1->engravidar();
echo $pessoa1->crescer();
echo $pessoa1->fazerEscolha();
echo $pessoa1->doar();

$pessoa2 = new Pessoas("Luiza");
echo $pessoa2->engravidar();
echo $pessoa2->crescer();
echo $pessoa2->fazerEscolha();
echo $pessoa2->doar();
?>