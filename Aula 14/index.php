<?php
require_once "ProdutoCrud.php";
require_once "ProdutoDAO.php";

$dao = new ProdutoDAO();

//Create
$dao->criarProduto(new Produto(1,"Tomate", 8.50));
$dao->criarProduto(new Produto(2,"Maçã", 6.75));
$dao->criarProduto(new Produto(3,"Queijo Brie", 45.90));
$dao->criarProduto(new Produto(4,"Iogurte Grego", 12.30));
$dao->criarProduto(new Produto(5,"Guaraná Jesus", 7.25));
$dao->criarProduto(new Produto(6,"Bolacha Bono", 4.99));
$dao->criarProduto(new Produto(7,"Desinfetante Urca", 9.80));
$dao->criarProduto(new Produto(8,"Prestobarba Bic", 15.40));

//Read
echo "Listagem Inicial:\n";
foreach ($dao->lerProduto() as $produto) {
    echo "{$produto->getCodigo()} - {$produto->getNome()} - R$ {$produto->getPreco()} \n";
}

//Upgrade
$dao->atualizarProduto(7,"Desinfetante Barbarex", 11.20);
echo "\nApos atualização: \n";
foreach($dao->lerProduto() as $produto) {
    echo "{$produto->getCodigo()} - {$produto->getNome()} - R$ {$produto->getPreco()}\n";
}

$dao->atualizarProduto(3,"Queijo Brie", 49.90);
echo "\nApos atualização: \n";
foreach($dao->lerProduto() as $produto) {
    echo "{$produto->getCodigo()} - {$produto->getNome()} - R$ {$produto->getPreco()}\n";
}

$dao->atualizarProduto(5,"Guaraná Jesus", 8.50);
echo "\nApos atualização: \n";
foreach($dao->lerProduto() as $produto) {
    echo "{$produto->getCodigo()} - {$produto->getNome()} - R$ {$produto->getPreco()}\n";
}

//delete
$dao->excluirProduto(1); 
echo "\nApós exclusão: \n";
foreach($dao->lerProduto() as $produto) {
    echo "{$produto->getCodigo()} - {$produto->getNome()} - R$ {$produto->getPreco()}\n";
}

$dao->excluirProduto(2); 
echo "\nApós exclusão: \n";
foreach($dao->lerProduto() as $produto) {
    echo "{$produto->getCodigo()} - {$produto->getNome()} - R$ {$produto->getPreco()}\n";
}
?>