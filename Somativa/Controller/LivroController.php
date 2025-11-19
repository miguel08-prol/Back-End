<?php
require_once __DIR__ . '/../Model/LivroDAO.php';
require_once __DIR__ . '/../Model/Livro.php';

class LivroController {
    private $dao;

    public function __construct() {
        $this->dao = new LivroDAO();
    }

    public function criar($titulo, $autor, $ano_publicacao, $genero_literario, $quantidade_disponivel) {
        $livro = new Livro($titulo, $autor, $ano_publicacao, $genero_literario, $quantidade_disponivel);
        $this->dao->criarLivro($livro);
    } 
    
    public function ler() {
        return $this->dao->lerLivro();
    }
  
    public function atualizarLivro($tituloOriginal, $novoTitulo, $autor, $ano_publicacao, $genero_literario, $quantidade_disponivel) {
        $this->dao->atualizarLivro($tituloOriginal, $novoTitulo, $autor, $ano_publicacao, $genero_literario, $quantidade_disponivel);
    }

    public function buscarPorTitulo($titulo) {
        return $this->dao->buscarPorTitulo($titulo);
    }

    public function buscarPorTituloParcial($tituloParcial) {
        return $this->dao->buscarPorTituloParcial($tituloParcial);
    }

    public function excluirLivro($titulo) {
        $this->dao->excluirLivro($titulo);
    }
}
?>