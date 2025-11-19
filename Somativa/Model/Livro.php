<?php

class Livro {
    private $titulo;
    private $autor;
    private $ano_publicacao;
    private $genero_literario;
    private $quantidade_disponivel;

    public function __construct($titulo, $autor, $ano_publicacao, $genero_literario, $quantidade_disponivel){
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->ano_publicacao = $ano_publicacao;
        $this->genero_literario = $genero_literario;
        $this->quantidade_disponivel = $quantidade_disponivel;
    }

    public function getAutor()
    {
        return $this->autor;
    }

    public function setAutor($autor)
    {
        $this->autor = $autor;

        return $this;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getAno_publicacao()
    {
        return $this->ano_publicacao;
    }

    public function setAno_publicacao($ano_publicacao)
    {
        $this->ano_publicacao = $ano_publicacao;

        return $this;
    }

    public function getGenero_literario()
    {
        return $this->genero_literario;
    }

    public function setGenero_literario($genero_literario)
    {
        $this->genero_literario = $genero_literario;

        return $this;
    }

    public function getQuantidade_disponivel()
    {
        return $this->quantidade_disponivel;
    }

    public function setQuantidade_disponivel($quantidade_disponivel)
    {
        $this->quantidade_disponivel = $quantidade_disponivel;

        return $this;
    }
}
?>