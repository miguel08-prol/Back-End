<?php 

class Aluno {
private $Nome;
private $Nota;

public function setNome($Nome) {
$this->Nome = ucwords(strtolower($Nome));
}
public function getNome() {
return $this->Nome;
}

public function setNota($Nota) {
if ($Nota >= 0 && $Nota <= 10) {$this->Nota = $Nota;return true; 
} else {return false; }
}

public function getNota() {
return $this->Nota;
}

public function informacao() {
return "Nome: " . $this->getNome() . "\nNota: " . $this->getNota();
}
}

// $aluno = new Aluno();

// $aluno->setNome("joão da silva");
// if ($aluno->setNota(8.5)) {
//     echo "Nota válida atribuída com sucesso.\n";
// } else {
//     echo "Nota inválida!\n";
// }


$aluno2 = new Aluno();

$aluno2->setNome("joão da silva");
if ($aluno2->setNota(11)) {
    echo "Nota válida atribuída com sucesso.\n";
} else {
    echo "Nota inválida!\n";
}

// echo $aluno->informacao();
echo $aluno2->informacao();
?>