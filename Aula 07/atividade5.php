<?php 
class Funcionario{
private $Nome;
private $Salario;

public function setNome($Nome) {
$this->Nome = ucwords(strtolower($Nome));
}
public function getNome() {
return $this->Nome;
}

public function setSlario(float $Salario) {
$this->Salario = $Salario;
}
public function getSalario() {
return $this->Salario;
}
}

$funcionario = new Funcionario();

$funcionario->setNome("José da silva");
$funcionario->setSlario(25000.00);

echo "Nome: " .$funcionario->getNome()."\nSalario: " .$funcionario->getSalario()."\n";

echo "Alteração:\n";

$funcionario->setNome("José da silva Pereira");
$funcionario->setSlario(2000.00);

echo "Nome: " .$funcionario->getNome()."\nSalario: " .$funcionario->getSalario();




?>