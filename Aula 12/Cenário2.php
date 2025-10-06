<?php 
//Classes:Personagem
//Subclasse:Lugar(Métodos: fazertreinamento(),doacao()).
//objetos:$grupo1,$grupo2



class Personagem {
private $nome;
private $dinheiro;

public function __construct($nome,$dinheiro) {
$this->setNome($nome);
$this->setDinheiro($dinheiro);
}

public function setNome($nome) {
$this->nome = $nome;
}

public function getNome() {
return $this->nome;
}

public function setDinheiro($dinheiro) {
$this->dinheiro = $dinheiro;
}

public function getDinheiro() {
return $this->dinheiro;
}
}

class Lugar extends Personagem {
private $instituicao;

public function __construct($nome, $dinheiro,$instituicao) {
parent::__construct($nome,$dinheiro);
$this->setInstituicao($instituicao);
}

public function setInstituicao($instituicao) {
$this->instituicao = $instituicao;
}

public function getInstituicao() {
return $this->instituicao;
}

public function fazertreinamento() {
if ($this->instituicao == "Cotil") {echo "Instituição:".$this->getInstituicao()."\n".$this->getNome().":"."\nVamos treinar!!";} else {echo $this->getNome().":"."Não viemos treinar\n";}
}

public function doacao() {
if ($this->instituicao == "APAE") {echo "Instituição:".$this->getInstituicao()."\n".$this->getNome()."\n"."Vamos doar: " .$this->getDinheiro()."\n";};
}
}

$grupo1 = new Lugar("Deadpool,Homem-Aranha", "R$25000.00","APAE");
echo $grupo1->fazertreinamento();
echo $grupo1->doacao();

$grupo2 = new Lugar("Deadpool,Homem-Aranha,Superman", "R$24000.00","Cotil");
echo $grupo1->fazertreinamento();
echo $grupo1->doacao();
?>