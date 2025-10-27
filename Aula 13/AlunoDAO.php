<?php
class AlunoDAO {
    private $alunos = [];

    private $arquivo = "aluno.json";//Cria o arquivo json para que os dados sejam armazenados

    //contrutor AlunoDAO --> carrega os dados do arquivo json ao inicio a aplicação
    public function __construct() {
    if(file_exists($this->arquivo)) {//Lê o conteudo do arquivo caso ele ja exista
    $conteudo = file_get_contents($this->arquivo);//atribui as informções do arquivo existente a variavel $conteudo 
    $dados= json_decode($conteudo,true);//Conveter o json em um array associativo 
    if ($dados) {//verifica se o array é nulo ou falso,caso seja valido e contenha conteudo,ele prossegue para logica dentro do if 
    foreach ($dados as $id => $info) { //percorre o array $dados relacionando chave e valor
        $this->alunos[$id] = new Aluno(//cria um novo objeto,ja com as chaves e os valores associados 
        $info['id'],
        $info['nome'],
        $info['curso']);}}}}

//Método auxiliar --> para salvar o array $alunos no arquivo json
private function salvarEmArquivo() {
$dados = [];

//Transfoma os objetos em arrays convencionais
foreach ($this->alunos as $id => $aluno) {
$dados[$id]=[
'id'=>$aluno->getId(),
'nome'=>$aluno->getNome(),
'curso'=>$aluno->getCurso()
];
}
//Converte para json formatado e grava o arquivo
file_put_contents($this->arquivo, json_encode($dados,JSON_PRETTY_PRINT));
}
    // CREATE - Adiciona um novo aluno 
    public function criarAluno(Aluno $aluno) {
        $this->alunos[$aluno->getId()] = $aluno;
        $this->salvarEmArquivo();
    }

    // READ - Retorna todos os alunos
    public function lerAluno() {
        return $this->alunos;
    }

    // READ - Retorna um aluno específico por ID
    public function buscarAlunoPorId($id) {
        return isset($this->alunos[$id]) ? $this->alunos[$id] : null;
    }

    // UPDATE - Atualiza nome e curso de um aluno
    public function atualizarAluno($id, $novoNome, $novoCurso) {
        if (isset($this->alunos[$id])) {
            $this->alunos[$id]->setNome($novoNome);
            $this->alunos[$id]->setCurso($novoCurso);
            return true; // Sucesso
        }
         $this->salvarEmArquivo();
    }

    // DELETE - Remove um aluno
    public function excluirAluno($id) {
        if (isset($this->alunos[$id])) {
            unset($this->alunos[$id]);
            return true; // Sucesso
        }
         $this->salvarEmArquivo();
    }

    // Contador de alunos
    public function contarAlunos() {
        $this->salvarEmArquivo();
        
    }
    
}
?>