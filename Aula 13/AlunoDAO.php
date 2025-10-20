<?php
class AlunoDAO {//Class DAO (Data Acess Object) para manipulação 
//Criando vetor = Array
private $alunos = [];//Array $alunos para armazenamento temporario dos objeto a serem manipulados,antes de ser enviados ao banco de dados. Foi criado  vazio inicialmento.

public function criarAluno(Aluno $aluno) {// método para criar um objeto no array alunos --> Create
$this->alunos [$aluno->getId()] = $aluno;
}

public function lerAluno() {//metodo para ler os dados de um objeto ja criado --> Read
return $this->alunos;
}

public function atualizarAluno($id,$novoNome,$novoCurso) {
if (isset($this->alunos [$id])) {
$this->alunos[$id]->setNome($novoNome);
$this->alunos[$id]->setCurso($novoCurso);
}
}

public function excluirAluno($id) {//metodo para excluir um objeto-->delete
unset($this->alunos[$id]);
}
}















?>
