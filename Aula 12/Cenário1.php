<?php 
//Classe->Substantivos e Métodos->Verbos
//Classes:Turistas
//Métodos:comidadastípicas(),nadar().
//objetos:$turista1,$turista2,$turista3

class Turistas{
private $local;
private $lazer;

public function __construct($local,$lazer)  {
$this->setLocal($local);
$this->setLazer($lazer);
}

public function setLocal($local) {
$this->local = $local;
}

public function getLocal() {
return $this->local;
}

public function setLazer($lazer) {
$this->lazer = $lazer;

}

public function getLazer() {
$this->lazer;
}

public function comidadastípicas() {
if ($this->local == "Brasil") {echo "\nPaís:".$this->local."\nComidas típicas: Feijoada, o Acarajé, o Churrasco, o Tacacá, a Moqueca, o Pão de Queijo e o Cuscuz Nordestino";}
elseif($this->local == "Japão") {echo "\nPaís:".$this->local."\nComidas típicas: sushi e sashimi";}
elseif($this->local == "Acre") {echo "\nPaís:".$this->local."\nComidas típicas: Pirarucu à Casaca, com o peixe regional, e o Kibe de Macaxeira";}else {echo "\nisso não está no roteiro\n";}
}

public function nadar() {
if($this->lazer == "Praia") {echo "Vamos na ".$this->lazer."nadar";}elseif($this->lazer == "Lago") {echo "Vamos no ".$this->lazer."nadar";}else {echo "\nIsso não está no roteiro!!\n";}
echo "\nNadar(lago ou praia):".$this->lazer."\n";
}


}

$turista1 = new Turistas("Brasil","Praia");
echo $turista1->comidadastípicas();
echo $turista1->nadar();

$turista2 = new Turistas("Japão","Praia");
echo $turista2->comidadastípicas();
echo $turista2->nadar();

$turista3 = new Turistas("Acre","Lago");
echo $turista3->comidadastípicas();
echo $turista3->nadar();
?>