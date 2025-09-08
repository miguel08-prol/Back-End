<?php 
//Modificadores de acessos:
//Existem 3 tipos: Public, Private e Protect
//Public NomedoAtributo: Método e atributos públicos.

//Private NomedoAtributo: métodos e atributos privados para acesso somente dentro da classe. Utilizamos os getter e setters para acessar-las

//Protect Nomedoatributo: métodos e atributos protegidos para acesso somente dea classes e de suas classes filhas

//Pacotes(Packages): sintaxe logo no inicio do codigo,que atribui de onde os arquivos pertence,ou seja,o o caminho da pasta em que ele está contida:
//Exemplo: namespace Aula_09;

//Interface: É um recurso no qual garante que obrigatoriamente a classe tenha que construir algum metodo previamente determinado.Funciona como uma promessa ou um contrato.
//Exemplo: Configuramos uma interface "Pagamento" que faz com que quaisquer classe que a implemente.tenha que obrigatoriamente construir o metodo "pagar".

// interface pagamento{ //interface de contrato de pagamento
// public function pagar($valor);

// }

// class cartaodecredito implements pagamento{
// public function pagar($valor) 
// {echo"Pagamento realizado com cartão de crédito,valor: $valor\n";}
// }

// class PIX implements pagamento{
// public function pagar($valor) {
// echo "Pagamento realizado via PIX,valor $valor\n";
// }
// }

// class dinheiroespecie implements pagamento {
// public function pagar($valor) {
// $valor = $valor - $valor * 0.10;
// echo"Pagamento realizado no dinheiro.Deconto de 10% aplicado.valor: $valor";
// }
// }

// $cred = new cartaodecredito();// Criando objetos 
// echo "Testando cartão de crédito para pagamento:".$cred->pagar(250);

// $pix = new PIX();
// echo"Testando pix para pagamento:".$pix->pagar(500);

// $dinheiro = new dinheiroespecie();
// echo "Testando dinheiro para pagamento".$dinheiro->pagar(600);





interface Forma {
    public function calcularArea($valor1, $valor2 = null);
}

class Quadrado implements Forma {
    public function calcularArea($valor1, $valor2 = null) {
        $lado = $valor1;
        return $lado * $lado;
    }
}

class Circulo implements Forma {
    public function calcularArea($valor1, $valor2 = null) {
        $diametro = $valor1;
        $raio = $diametro / 2;
        return 3.14 * ($raio * $raio);
    }
}

class Pentagono implements Forma {
    public function calcularArea($valor1, $valor2 = null) {
        $perimetro = $valor1;
        $apotema = $valor2;
        return ($perimetro * $apotema) / 2;
    }
}

class Hexagono implements Forma {
    public function calcularArea($valor1, $valor2 = null) {
        $lado = $valor1;
        return (3 * sqrt(3) / 2) * ($lado * $lado);
    }
}

$quadrado = new Quadrado();
$areaQuadrado = $quadrado->calcularArea(5);
echo "A área do quadrado é: " . $areaQuadrado . "\n";

$circulo = new Circulo();
$areaCirculo = $circulo->calcularArea(24);
echo "A área do círculo é: " . $areaCirculo . "\n";

$pentagono = new Pentagono();
$areaPentagono = $pentagono->calcularArea(24, 8); 
echo "A área do pentágono é: " . $areaPentagono . "\n";

$hexagono = new Hexagono();
$areaHexagono = $hexagono->calcularArea(6);
echo "A área do hexágono é: " . $areaHexagono . "\n";

?>
