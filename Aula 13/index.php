<?php
//puxar os codigos para esse index
require_once "CRUD.php";
require_once "AlunoDAO.php";

$dao = new AlunoDAO(); //Objeto da classe AlunoDAO para testar metodos CRUD

//Create
$dao->criarAluno(new Aluno(1,"Brunão","JavaScript"));
$dao->criarAluno(new Aluno(2,"Samuel","Java"));
$dao->criarAluno(new Aluno(3,"Celso","PHP"));
$dao->criarAluno(new Aluno(4,"Gabriel","Full stack"));
$dao->criarAluno(new Aluno(5,"Maria Eduarda","Youtuber"));
$dao->criarAluno(new Aluno(6,"Fillipo","Mecanico"));
$dao->criarAluno(new Aluno(7,"Mateus","Stremer"));
$dao->criarAluno(new Aluno(8,"Mariana","Eletrica"));
$dao->criarAluno(new Aluno(9,"Luiza","Solda"));

//Read
echo "Listagem Inicial:\n";
foreach ($dao->lerAluno() as $aluno) {
    echo "{$aluno->getId()} - {$aluno->getNome()} - {$aluno->getCurso()} \n";
}

//Upgrade
$dao->atualizarAluno(1,"Eduardo","C#");
echo "\nApos atualização: \n";
foreach($dao->lerAluno() as $aluno) {
    echo "{$aluno->getId()} - {$aluno->getNome()} - {$aluno->getCurso()}\n";
}

$dao->atualizarAluno(2,"Samuel","Mecanica");
echo "\nApos atualização: \n";
foreach($dao->lerAluno() as $aluno) {
    echo "{$aluno->getId()} - {$aluno->getNome()} - {$aluno->getCurso()}\n";
}

$dao->atualizarAluno(3,"Brunão","PHP");
echo "\nApos atualização: \n";
foreach($dao->lerAluno() as $aluno) {
    echo "{$aluno->getId()} - {$aluno->getNome()} - {$aluno->getCurso()}\n";
}

$dao->atualizarAluno(4,"Miguel","Full Stack");
echo "\nApos atualização: \n";
foreach($dao->lerAluno() as $aluno) {
    echo "{$aluno->getId()} - {$aluno->getNome()} - {$aluno->getCurso()}\n";
}

//delete
$dao->excluirAluno(1); //Excluindo objeto $aluno2 --> id=2
echo "\nApós exclusão: \n";
foreach($dao->lerAluno() as $aluno) {
    echo "{$aluno->getId()} - {$aluno->getNome()} - {$aluno->getCurso()}\n";
}

$dao->excluirAluno(2); 
echo "\nApós exclusão: \n";
foreach($dao->lerAluno() as $aluno) {
    echo "{$aluno->getId()} - {$aluno->getNome()} - {$aluno->getCurso()}\n";
}

$dao->excluirAluno(3); 
echo "\nApós exclusão: \n";
foreach($dao->lerAluno() as $aluno) {
    echo "{$aluno->getId()} - {$aluno->getNome()} - {$aluno->getCurso()}\n";
}

$dao->excluirAluno(4); 
echo "\nApós exclusão: \n";
foreach($dao->lerAluno() as $aluno) {
    echo "{$aluno->getId()} - {$aluno->getNome()} - {$aluno->getCurso()}\n";
}
?>