<?php 
namespace Aula_10;

interface Animal {
public function fazersom();
}

class cachorro implements Animal {
private $nome;

public function fazersom() {
echo "O Cachorro($this->nome) faz AU AU!!";
}
}

class gato implements Animal {
public $nome;
public function fazersom() {
echo "O gato($this->nome) faz MIU!!";
}
}

class vaca implements Animal{
public $nome;

public function fazersom() {
echo "A vaca ($this->nome) faz MUUUUUUU!!";
}
}


$cachorro1 = new cachorro();
$cachorro->nome ="Rodrigo";

$gato = new gato();
$gato->nome ="Mel";

$vaca = new vaca();
$vaca->nome ="Mimoza";

?>