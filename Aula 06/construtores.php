<?php 
class produtosMercado { //Criando classes
//criando atributos
public $nome;
public $categoria;
public $fornecedor;
public $qtde_estoque;

// criando metodos
public function atualizarEstoque($qtde_vendida) {
$this->qtde_estoque -= $qtde_vendida;
return $this->qtde_estoque;
}}

//criando objetos sem construtor feito
$produto1 = new produtosMercado();
$produto1 -> nome = "Suco tang";
$produto1 -> categoria = "Bebidas";
$produto1 -> fornecedor = "Mandalez";
$produto1 -> qtde_estoque = 200;

$produto2 = new produtosMercado();
$produto2 -> nome = "Enegético monster";
$produto2 -> categoria = "Bebidas";
$produto2 -> fornecedor = "Coca-cola";
$produto2 -> qtde_estoque = 150;


class produtosMercado2 { //Criando classes
//criando atributos
public $nome;
public $categoria;
public $fornecedor;
public $qtde_estoque;

// criando metodos
public function __construct($nome,$categoria,$fornecedor,$qtde_estoque) {
$this->nome = $nome;
$this->categoria = $categoria;
$this->fornecedor = $fornecedor;
$this->qtde_estoque = $qtde_estoque;}
}

//criando objetos com construtor feito
$produto = new produtosMercado2("Suco tang","Bebidas","Mandalez",200);
$produto2 = new produtosMercado2("Energético Monster","Bebidas","Coca-cola",150);




?>