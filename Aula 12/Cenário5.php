<?php 
//Classes:Usuários
//Métodos:emprestimoslivro()
//objetos:$Usuario1,$Usuario2
//A classe Usuaios se relaciona com usuario,livro,qtd


class Usuaios {
private $usuaios;
private $livro;
private $qtd;

public function __construct($usuaios,$livro,$qtd) {
$this->setNome($usuaios);
$this->setLivro($livro);
$this->setQtd($qtd);
}

public function setNome($usuaios) {
$this->usuaios = $usuaios;
}

public function getNome() {
return $this->usuaios;
}

public function setLivro($livro) {
$this->livro = $livro;
}

public function getLivro() {
return $this->livro;
}

public function setQtd($qtd) {
$this->qtd = $qtd;
}

public function getQtd() {
return $this->qtd;
}


public function emprestimoslivro() {
echo "\nUsuário:".$this->usuaios."\nLivro:".$this->livro."\nQtd:".$this->qtd."\n";
}

}


$Usuario1 = new Usuaios("Miguel","Java",152);
echo $Usuario1->emprestimoslivro();


$Usuario2 = new Usuaios("Luiza","Bancos de Dados",562);
echo $Usuario2->emprestimoslivro();

?>