<?php
require_once 'Bebida.php';

class BebidaDAO {
    private $bebidasArray = [];
    private $arquivoJson = 'bebidas.json';

    public function __construct(){
        if(file_exists($this->arquivoJson)){
            $conteudoArquivo = file_get_contents($this->arquivoJson);
            $dadosArquivoEmArray = json_decode($conteudoArquivo, true);

            if ($dadosArquivoEmArray){
                foreach ($dadosArquivoEmArray as $nome => $info){
                    // Converte os valores para os tipos corretos
                    $valor = is_numeric($info['valor']) ? floatval($info['valor']) : 0;
                    $qtde = is_numeric($info['qtde']) ? intval($info['qtde']) : 0;
                    
                    $this->bebidasArray[$info['nome']] = new Bebida(
                        $info['nome'],
                        $info['categoria'],
                        $info['volume'],
                        $valor,
                        $qtde
                    );
                }
            }
        }
    }

    private function salvarArquivo(){
        $dadosParaSalvar = [];
        
        foreach ($this->bebidasArray as $bebida){
            $dadosParaSalvar[$bebida->getNome()] = [
                'nome' => $bebida->getNome(),
                'categoria' => $bebida->getCategoria(),
                'volume' => $bebida->getVolume(),
                'valor' => floatval($bebida->getValor()),
                'qtde' => intval($bebida->getQtde())
            ];
        }
        
        file_put_contents($this->arquivoJson, 
            json_encode($dadosParaSalvar, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
        );
    }

    // CREATE
    public function criarBebida(Bebida $bebida){
        $this->bebidasArray[$bebida->getNome()] = $bebida;
        $this->salvarArquivo();
    }

    // READ
    public function lerBebidas(){
        return $this->bebidasArray;
    }
    
    // UPDATE
    public function atualizarBebida($nomeAntigo, $nome, $categoria, $volume, $valor, $qtde){
        if(isset($this->bebidasArray[$nomeAntigo])){
            // Se o nome mudou, precisamos remover o antigo e criar um novo
            if($nomeAntigo !== $nome) {
                $bebida = $this->bebidasArray[$nomeAntigo];
                unset($this->bebidasArray[$nomeAntigo]);
                
                $bebida->setNome($nome);
                $bebida->setCategoria($categoria);
                $bebida->setVolume($volume);
                $bebida->setValor(floatval($valor));
                $bebida->setQtde(intval($qtde));
                
                $this->bebidasArray[$nome] = $bebida;
            } else {
                // Se o nome não mudou, apenas atualiza os dados
                $this->bebidasArray[$nome]->setCategoria($categoria);
                $this->bebidasArray[$nome]->setVolume($volume);
                $this->bebidasArray[$nome]->setValor(floatval($valor));
                $this->bebidasArray[$nome]->setQtde(intval($qtde));
            }
            $this->salvarArquivo();
            return true;
        }
        return false;
    }

    // Buscar bebida por nome
    public function buscarBebida($nome) {
        return isset($this->bebidasArray[$nome]) ? $this->bebidasArray[$nome] : null;
    }

    // DELETE
    public function excluirBebida($nome){
        if(isset($this->bebidasArray[$nome])){
            unset($this->bebidasArray[$nome]);
            $this->salvarArquivo();
            return true;
        }
        return false;
    }
}
?>