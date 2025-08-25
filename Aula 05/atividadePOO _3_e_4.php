<?php
//Exercicio 3
class Usuario {
public $Nome;
public $CPF;
public $Sexo;
public $Email;
public $Estado_civil;
public $Cidade;

public $Endereco;

public $CEP;

public function __construct($Nome,$CPF,$Sexo,$Email,$Estado_civil,$Cidade,$Estado,$Endereco,$CEP) {
$this->Nome = $Nome;
$this->CPF = $CPF;
$this->Sexo = $Sexo;
$this->Email = $Email;
$this->Estado_civil = $Estado_civil;
$this->Cidade = $Cidade;
$this->Endereco = $Endereco;
$this ->CEP = $CEP;
}
public function testando_Reservista() {
    if ($this->Sexo == "Masculino") {echo "Apresente seu certificado de reservista do tiro de guerra!";}else {echo "Tudo certo";}
}

public function Casamento($anos_casado) {
        
        if (strtolower($this->Estado_civil) === 'casado') {
            echo "Parabéns pelo seu casamento de " . $anos_casado . " anos!";
        } else {
            echo "oloco";
        }
    }
}

//Exercicio 4

$Usuario1 = new Usuario("Josenildo Afonso Souza","100.200.300-40",
"Masculino","josenewdo.souza@gmail.com","Casado","Xique-Xique",
"Bahia","Rua da amizade, 99","40123-98");

$usuario2 = new Usuario("Valentina Passos Scherrer","070.070.060-70","Feminino",
"scherrer.valen@outlook.com","Divorciada","Iracemápolis","São Paulo",
"Avenida da saudade, 1942","23456-24");

$usuario3 = new Usuario("Claudio Braz Nepumoceno","575.575.242-32","Masculino","Clauclau.nepumoceno@gmail.com",
"Solteiro","Piripiri","Piauí","Estrada 3, 33","12345-99");

$Usuario1 -> testando_Reservista();
$usuario2 -> Casamento(12);



?>