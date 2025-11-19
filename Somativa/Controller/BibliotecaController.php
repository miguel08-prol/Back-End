<?php
require_once __DIR__ . '/../Model/BibliotecaDAO.php';
require_once __DIR__ . '/../Model/Biblioteca.php';

class BebidaController {
    private $dao;

    public function __construct() {
        $this->dao = new BebidaDAO();
    }

    public function criar($nome, $categoria, $volume, $valor, $qtde) {
        $bebida = new Bebida($nome, $categoria, $volume, $valor, $qtde);
        $this->dao->criarBebida($bebida);
    } 
    
    public function ler() {
        return $this->dao->lerBebidas();
    }
  
    public function atualizar($nomeOriginal, $novoNome, $categoria, $volume, $valor, $qtde) {
        $this->dao->atualizarBebida($nomeOriginal, $novoNome, $categoria, $volume, $valor, $qtde);
    }

    public function buscarPorNome($nome) {
        return $this->dao->buscarPorNome($nome);
    }

    // --- AQUI ESTÁ O MÉTODO QUE FALTAVA ---
    public function buscarParcial($nomeParcial) {
        return $this->dao->buscarPorNomeParcial($nomeParcial);
    }
    // ---------------------------------------

    public function deletar($nome) {
        $this->dao->excluirBebida($nome);
    }
}
?>