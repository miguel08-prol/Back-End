<?php 
class Pessoa{
private $Nome;
private $Idade;
private $Email;

public function __construct($Nome,$Idade,$Email) {
$this->setNome($Nome);
$this->setIdade($Idade);
$this->setEmail($Email);
}

public function setNome($Nome){ 
$this->Nome = ucwords(strtolower($Nome));
}

public function getNome() {
return $this->Nome;
}

public function setIdade($Idade) {
$this->Idade = abs((int)$Idade);

}

public function getIdade() {
return $this->Idade;
}

public function setEmail($Email) {
$this->Email = $Email;
}

public function getEmail() {
return $this->Email;
}

public function exibirInfo(){
return "Nome do aluno: $this->Nome\nIdade: $this->Idade\nEmail: $this->Email";
}
}

$pessoa = new Pessoa("MiGueL MasSANE","17","miguel@exemplo.com.");

echo $pessoa->exibirInfo();
?>