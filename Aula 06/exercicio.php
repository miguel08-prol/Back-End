<?php 

//Exercicio 1
class Moto {
public $Marca;
public $Modelo;
public $Ano;
public $Bateu;
public $Revisao;

public function __construct($Marca,$Modelo,$Ano,$Bateu,$Revisao,){  
$this->Marca = $Marca;  
$this->Modelo = $Modelo;
$this->Ano = $Ano;
$this->Bateu = $Bateu;
$this->Revisao = $Revisao;
}  
}

//Exercicio 2
$Moto1 = new Moto("Honda", "CBR 600", "Vermelha",3,false);
$Moto2 = new Moto("Yamaha", "MT-07", "Azul",1, true);
$Moto3 = new Moto("Kawasaki", "Ninja 400", "Preta", 0,true);


//Exercicio 3

public function __construct($dia,$mes,$ano) {
$this->dia = $dia;
$this->mes = $mes;
$this->ano = $ano;
}

public function __construct($nome,$idade,$CPF,$telefone,$Endereco,$estado_civil,$sexo) {
$this->nome = $nome;
$this->idade = $idade;
$this->CPF = $CPF;
$this->telefone = $telefone;
$this->Endereco = $Endereco;
$this->estado_civil = $estado_civil;
$this->sexo = $sexo;
}

public function __construct($Marca,$nome,$categoria,$data_fabricacao,$data_venda) {
$this->Marca = $Marca;
$this->nome = $nome;
$this->categoria = $categoria;
$this->data_fabricacao = $data_fabricacao;
$this->data_venda = $data_venda;
}
?>
