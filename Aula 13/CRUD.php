<?php 
class Aluno {
    private $id;
    private $nome;
    private $curso;
    
    public function __construct($id, $nome, $curso) {
        $this->id = $id;
        $this->nome = $nome;
        $this->curso = $curso;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setCurso($curso) {
        $this->curso = $curso;
    }

    public function getCurso() {
        return $this->curso;
    }

    // Método adicional para exibir dados formatados
    public function exibirDados() {
        return "{$this->id} - {$this->nome} - {$this->curso}";
    }
}
?>