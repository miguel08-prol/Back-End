<?php 
class Produto {
private $codigo;    
private $nome;

private $preco;
    
    public function __construct($codigo, $nome, $preco) {
        $this->codigo = $codigo;
        $this->nome = $nome;
        $this->preco = $preco;
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function getCodigo() {
        return $this->codigo;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setPreco($preco) {
        $this->preco = $preco;
    }

    public function getPreco() {
        return $this->preco;
    }

    public function exibirDados() {
        return "{$this->codigo} - {$this->nome} - {$this->preco}";
    }
}
?>