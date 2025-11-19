<?php
require_once __DIR__ . '/Livro.php';
require_once __DIR__ . '/connection.php';
class LivroDAO {
    private $conn;

    public function __construct() {
        $this->conn = Connection::getInstance();

        $this->conn->exec("
         CREATE TABLE IF NOT EXISTS livro (
          id INT AUTO_INCREMENT PRIMARY KEY,
          titulo VARCHAR(200),
          autor VARCHAR(150),
          ano_publicacao INT,
          genero_literario VARCHAR(100),
          quantidade_disponivel INT
            )
        ");
    }

    public function criarLivro(Livro $livro) {
        $stmt = $this->conn->prepare("
            INSERT INTO livro (titulo, autor, ano_publicacao, genero_literario, quantidade_disponivel)
            VALUES (:titulo, :autor, :ano_publicacao, :genero_literario, :quantidade_disponivel)
        ");
        $stmt->execute([
            ':titulo' => $titulo->getTitulo(),
            ':autor' => $autor->getAutor(),
            ':ano_publicacao' => $ano_publicacao->getAno_publicacao(),
            ':genero_literario' => $genero_literario->getGenero_literario(),
            ':quantidade_disponivel' => $quantidade_disponivel->getQuantidade_disponivel()
        ]);
    }

    public function lerLivro() {
        $stmt = $this->conn->query("SELECT * FROM livro");
        $result = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = new Livro(
                $row['titulo'],
                $row['autor'],
                $row['ano_publicacao'],
                $row['genero_literario'],
                $row['quantidade_disponivel']
            );
        }
        return $result;
    }

    public function atualizarLivro($tituloOriginal, $novoTitulo, $autor, $ano_publicacao, $genero_literario, $quantidade_disponivel) {
        $stmt = $this->conn->prepare("
            UPDATE livro
            SET nome = :novoTitulo, autor = :autor, autor = :autor, ano_publicacao = :ano_publicacao, genero_literario = :genero_literario, quantidade_disponivel = :quantidade_disponivel
            WHERE nome = :tituloOriginal
        ");
        $stmt->execute([
            ':novoTitulo' => $novoTitulo,
            ':autor' => $autor,
            ':ano_publicacao' => $ano_publicacao,
            ':genero_literario' => $genero_literario,
            ':quantidade_disponivel' => $quantidade_disponivel,
            ':tituloOriginal' => $tituloOriginal
        ]);
    }

    public function excluirLivro($titulo) {
        $stmt = $this->conn->prepare("DELETE FROM livro WHERE titulo = :titulo");
        $stmt->execute([':titulo' => $titulo]);
    }

    public function buscarPorTitulo($titulo) {
        $stmt = $this->conn->prepare("SELECT * FROM livro WHERE titulo = :titulo LIMIT 1");
        $stmt->execute([':titulo' => $titulo]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            return new Livro(
                $row['titulo'],
                $row['autor'],
                $row['ano_publicacao'],
                $row['genero_literario'],
                $row['quantidade_disponivel']
            );
        }
        return null;
    }
    
 
    public function buscarPorTituloParcial($tituloParcial) {
        $stmt = $this->conn->prepare("SELECT * FROM livro WHERE titulo LIKE :termo OR autor LIKE :termo");
        $searchTerm = '%' . $tituloParcial . '%';
        $stmt->execute([':termo' => $searchTerm]);
        $result = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = new Livro(
                $row['titulo'],
                $row['autor'],
                $row['ano_publicacao'],
                $row['genero_literario'],
                $row['quantidade_disponivel']
            );
        }
        return $result;
    }
}
?>