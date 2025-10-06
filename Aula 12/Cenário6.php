<?php 
//Classes:Clientes
//Métodos:Compraringresso()
//objetos:$Cliente1,$Cliente2
//A classe Clientes se relaciona com clientes,filme,qtdingresso,sessao

class Clientes {
private $clientes;
private $filme;
private $qtdingresso;
private $sessao;


public function __construct($clientes,$filme,$qtdingresso,$sessao) {
$this->setClientes($clientes);
$this->setFilme($filme);
$this->setQtdingresso($qtdingresso);
$this->setessao($sessao);
}

public function setClientes($clientes) {
$this->clientes = $clientes;
}

public function getClientes() {
return $this->clientes;
}

public function setFilme($filme) {
$this->filme = $filme;
}

public function getFilme() {
return $this->filme;
}

public function setQtdingresso($qtdingresso) {
$this->qtdingresso = $qtdingresso;
}

public function getQtdingresso() {
return $this->qtdingresso;
}

public function getessao() {
return $this->sessao;
}

public function setessao($sessao) {
$this->sessao = $sessao;
}

public function Compraringresso() {
echo "\nCliente:".$this->clientes."\nFilme:".$this->filme."\nQtd de ingresso:".$this->qtdingresso."\n"."Sessão:".$this->sessao."\n";
}

}


$Cliente1 = new Clientes("Douglas","Superman",4,"14:00");
echo $Cliente1->Compraringresso();


$Cliente2 = new Clientes("Sueli","Deadpool",2,"10:50");
echo $Cliente2->Compraringresso();

?>