<?php 
class Produto{
private $Nome;
private $Preco;
private $Estoque;

public function setNome($Nome) {
$this->Nome = ucwords(strtolower($Nome));
}
public function getNome() {
return $this->Nome;
}

public function setPreco($Preco) {
$this->Preco = $Preco;
}

public function getPreco() {
return $this->Preco;
}

public function setEstoque($Estoque) {
$this->Estoque = $Estoque;
}

public function getEstoque() {
return $this->Estoque;
}

public function inform() {
echo "Produto: ".$this->getNome()."\nPreço: ".$this->getPreco()."\nEstoque: ".$this->getEstoque();
}


}

$produto = new Produto();
$produto->setNome("Queijo");
$produto->setPreco(34.50);
$produto->setEstoque(120);

echo $produto->inform();
?>
