<?php
# Atividade 1
/*Desenvolva um codigo com a mesma estrutura abaixo ,porém com seu dados*/

use Dom\Element;

echo "olá! \n";
$nome  = "Miguel \n";
$idade = "17";
$ano_atual = "2025";
$data_nasc = $ano_atual - $idade;
echo $nome, "Você nasceu em: ", $data_nasc, "\n"; 
?>

<?php
# Atividade 2:Dado uma frase “Programação em php.” transformá‐la em maiúscula, imprima,depois em minúscula e imprima de novo.

$maiuscolo = "PROGRAMAÇÃO EM PHP \n";      #strtoupper=deixa maisculo
echo "Maiusculo: ",strtoupper($maiuscolo);
$minusculo = strtolower($maiuscolo); # strtolower=deixa minusculo
echo "Minusculo: ",$minusculo, "\n";
?>

<?php
# Atividade 3:Numa dada frase “O PHP foi criado em mil novecentos e noventa e cinco”.Trocar o “O” (letra) por “0”(zero), o “a” por “4” e o “i” por “1”.

$original = "O PHP foi criado em mil novecentos e noventa e cinco \n";
echo "Original: ",$original;
$cripitografado = str_replace (['O','a','i'],['0','4','1'],$original);

echo "Cripitografado: ",$cripitografado;

?>