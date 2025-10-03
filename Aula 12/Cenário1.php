<?php 
//Classe->Substantivos e Métodos->Verbos

//Classes:Turistas


//Métodos:Comer comidadas típicas e nadar em rios ou praias.

class Turistas{
private $local;
private $comida;
private $lazer;

public function __construct($local,$comida,$lazer)  {
$this->setLocal($local);
$this->setComida($comida);
$this->setLazer($lazer);
}

public function setLocal($local) {
$this->local = $local;
}

public function getLocal() {
return $this->local;
}
public function setComida($comida) {
$this->comida = $comida;
}

public function getComida() {
return $this->comida;
}
public function setLazer($lazer) {
$this->lazer = $lazer;

}

public function getLazer() {
$this->lazer;
}

public function comidadastípicas() {
return "Pais:".$this->local."\n Comida típica:".$this->comida."\n Lazer(lago ou paia):".$this->lazer;
}

public function nadar() {
return "\n Nadar(lago ou praia):".$this->lazer;
}


}

$turista1 = new Turistas("Brasil","Brigadeiro","Praia");
echo $turista1->comidadastípicas();
echo $turista1->nadar();

?>