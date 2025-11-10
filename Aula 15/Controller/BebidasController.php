<?php
require_once __DIR__ . '/../Model/BebidaDAO.php';
require_once __DIR__ . '/../Model/Bebida.php';

class BebidaController {
    private $dao;

    public function __construct() {
        $this->dao = new BebidaDAO();
    }

    public function ler() {
        return $this->dao->lerBebidas();
    }

    public function criar($nome, $categoria, $volume, $valor, $qtde) {
        // Converte para os tipos corretos
        $valor = floatval($valor);
        $qtde = intval($qtde);
        
        $bebida = new Bebida($nome, $categoria, $volume, $valor, $qtde);
        $this->dao->criarBebida($bebida);
    }

    // Método atualizado para editar
    public function atualizar($nomeAntigo, $nome, $categoria, $volume, $valor, $qtde) {
        // Converte para os tipos corretos
        $valor = floatval($valor);
        $qtde = intval($qtde);
        
        return $this->dao->atualizarBebida($nomeAntigo, $nome, $categoria, $volume, $valor, $qtde);
    }

    // Buscar bebida por nome
    public function buscar($nome) {
        return $this->dao->buscarBebida($nome);
    }

    public function deletar($nome) {
        return $this->dao->excluirBebida($nome);
    }
}
?>