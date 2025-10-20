<?php
//puxar os codigos para esse index
require_once "CRUD.php";
require_once "AlunoDAO.php";

$dao = new AlunoDAO(); //Objeto da classe AlunoDAO para testar metodos CRUD

//Create
$dao->criarAluno(new Aluno(1,"Brunão","JavaScript"));
$dao->criarAluno(new Aluno(2,"Samuel","Java"));
$dao->criarAluno( new Aluno(3,"Celso","PHP"));


//Read
echo "Listagem Inicial:\n";
foreach ($dao->lerAluno() as $aluno) {echo "{$this->aluno->getId()} - {$this->aluno->getNome()} - {$this->aluno->getCurso()} \n";}

//Upgrade
$dao->atualizarAluno(1,"Eduardo","C#");
echo "\nApos atualização: ";
foreach($dao->lerAluno() as $aluno) 
{echo "{$aluno->getId()} -{$aluno->getNome()} - {$aluno->getCurso()}\n";}

//delete
$dao->excluirAluno(1); //Excluindo objeto $aluno2 --> id=2
echo "\n Após exclusão: ";
foreach($dao->lerAluno() as $aluno) 
{echo "{$aluno->getId()} -{$aluno->getNome()} - {$aluno->getCurso()}\n";}








?>