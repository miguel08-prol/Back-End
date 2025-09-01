<?php 
class Pessoa{
private $Nome;
private $CPF;
private $Telefone;
private $Idade;
private $Email;

private $Senha;
//Criando o construtor para a classe Pessoa.
public function __construct($Nome,$CPF,$Telefone,$Idade,$Email,$Senha) {
$this->setNome($Nome);
$this->setCPF($CPF);
$this->setTelefone($Telefone);
$this->setIdade($Idade);
$this->Email = $Email;
$this->Senha = $Senha;
}

//UCWORDS:Deixas todas as iniciais maiusculas 
//Strtolower:Deixa todo o texto minusculo

//Getter e setter para $nome
public function setNome($Nome){ 
$this->Nome = ucwords(strtolower($Nome));  //UCWORDS:Deixas todas as iniciais maiusculas 
//Strtolower:Deixa todo o texto minusculo
}

public function getNome() {
return $this->Nome;
}


//Getter e setter para $CPF
public function setCPF($CPF) {
$this->CPF = preg_replace('/\D/','',$CPF); //preg_replace:Altera a estrutura de uma string
//pattern:'/D/' significa qualquer caracter que não seja digito '.','-'
}

public function getCPF() {
return $this->CPF;
}

//Getter e setter para $Telefone
public function setTelefone($Telefone){
$this->Telefone = preg_replace('/\D/','',$Telefone);
}


public function getTelefone() {
return $this->Telefone;
}

public function setIdade($Idade) {
$this->Idade = abs((int)$Idade);//Abs($Variavel):Garante número positivo
//(Int)$Variavel: Garante valor inteiro
}

public function getIdade() {
return $this->Idade;
}

public function exibirInfo(){
return "Nome do aluno: $this->Nome\nCPF: $this->CPF\nIdade: $this->Idade\nTelefone: $this->Telefone\n
Email: $this->Email\nSenha: $this->Senha";
}
}

$aluno = new Pessoa("mIGuIL MasSANe",1220-20281.29-2,
"(19)9813-1234",-17,"teste@teste.com","teste123");

//echo $aluno->getNome();
echo $aluno->exibirInfo();

?>