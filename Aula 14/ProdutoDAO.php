<?php 
class ProdutoDAO {
    private $produtos = [];
    private $arquivo = "produtos.json";

    public function __construct() {
        if(file_exists($this->arquivo)) {
            $conteudo = file_get_contents($this->arquivo); 
            $dados = json_decode($conteudo, true);
            if ($dados) { 
                foreach ($dados as $codigo => $info) {
                    $this->produtos[$codigo] = new Produto(
                        $info['codigo'],
                        $info['nome'],
                        $info['preco']
                    );
                }
            }
        }
    }

    private function salvarEmArquivo() {
        $dados = [];

        foreach ($this->produtos as $codigo => $produto) {
            $dados[$codigo] = [
                'codigo' => $produto->getCodigo(),
                'nome' => $produto->getNome(),
                'preco' => $produto->getPreco()
            ];
        }
        file_put_contents($this->arquivo, json_encode($dados, JSON_PRETTY_PRINT));
    }

    public function criarProduto(Produto $produto) {
        $this->produtos[$produto->getCodigo()] = $produto;
        $this->salvarEmArquivo();
        return true;
    }

    // READ
    public function lerProduto() {
        return $this->produtos;
    }

   
    public function buscarProdutoPorCodigo($codigo) {
        return isset($this->produtos[$codigo]) ? $this->produtos[$codigo] : null;
    }

    // Upgrade
    public function atualizarProduto($codigo, $novoNome, $novoPreco) {
        if (isset($this->produtos[$codigo])) {
            $this->produtos[$codigo]->setNome($novoNome);
            $this->produtos[$codigo]->setPreco($novoPreco);
            $this->salvarEmArquivo();
            return true;
        }
        return false;
    }

    //Delete
    public function excluirProduto($codigo) {
        if (isset($this->produtos[$codigo])) {
            unset($this->produtos[$codigo]);
            $this->salvarEmArquivo();
            return true;
        }
        return false;
    }

    public function contarProdutos() {
        return count($this->produtos);
    }
}
?>