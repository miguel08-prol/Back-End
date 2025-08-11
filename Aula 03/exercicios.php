<?php
#Atividade 1 Verificação de Idade

// $idade = readline("Digite sua idade: ");
// if ($idade >17) {echo "Maior de idade";}else {echo "Menor de idade";} 

// #Atividade 2 Classificação de Nota

// $nota = readline("Digite a nota do aluno:  ");
// if ($nota >=9) {echo "Exelente,continue assim!!!";}elseif ($nota >=7) {echo "Bom";}else {echo "Reprovado,estude mais";}

#Atividade 3 Dia da Semana

// $Semana = readline ("Digite um número de 1 a 7: ");
// switch ($semana) {
// case $semana = 1:
// echo "Domingo";

// break;
// case $semana = 2:
//  echo "Segunda-feira";
// break;
// case $semana = 3:
//  echo "Terça-feira";
// break;
// case $semana = 4;
// echo "Quarta-feira";
// break;
// case $semana = 5:
//  echo "Quinta-feira";
// break;
// case $semana = 6:
//  echo "Sexta-feira";
// break;
// case $semana = 7;
// echo "Sábado";
// break;
// default:
// echo "Error,valor invalido";
// }

#Atividade 4 Calculadora Simples

// $valor1 = readline("Digite um valor: ");
// $valor2 = readline("Digite um 2° valor: ");

// $operação = readline("Digite uma uma dessa operações (+, -, *, /): ");
// $resultado;

// switch ($operação) {
// case $operação == "+":
//  $resultado = $valor1 + $valor2;
//  echo "Resultado: $resultado";
// break;
// case $operação == "-":
//  $resultado = $valor1 - $valor2;
//  echo "Resultado: $resultado";
// break;
// case $operação == "*":
//  $resultado = $valor1 * $valor2;
//  echo "Resultado: $resultado";
// break;
// case $operação == "/":
//  $resultado = $valor1 / $valor2;
//  echo "Resultado: $resultado";
// break;
// default:
// echo "Error,valor não reconhecido";
// }

#Atividade 5 Contagem Progressiva

// for ($i = 1; $i <= 10; $i++) {
// echo "Número: $i";}

#Atividade 6 Contagem Regressiva

// for ($i = 10; $i >= 1; $i--) {
// // echo "Regressiva: $i";
// }


#Atividade 7 Números Pares

// $valor = readline ("Digite um valor: ");

// for ($i = 0; $i <= $valor; $i++) {
// if ($i % 2 == 0) {
// echo "$i\n";} 
// }

#Atividade 8 Tabuada

// $valor = readline("Digite um número que queira treinar a tabuada: ");
// for ($i = 0; $i <= 10; $i++) {
// $resultado = $valor * $i;
// echo "Resultado: $resultado\n";
// }

#Atividade 9 Classificação de Temperatura

// $temperatura = readline("Digite a temperatura da sua cidade: ");

// if ($temperatura <= 15) {
// echo "O clima está frio, leve um agasalho.";}else if ($temperatura > 15 && $temperatura <= 25) {
// echo "O clima está agradavel.";
// } else {echo "O clima está quente, lembre-se de tomar água.";}

#Atividade Menu Interativo

for ($i = 0; $i < 5; $i++) {
    
echo "Menu:\n";
echo "1 - Olá\n";
echo "2 - Data Atual\n";
echo "3 - Sair\n";

$escolha = readline("Escolha uma opção: ");

switch ($escolha) {
case '1':
echo "Olá! Bem-vindo(a)!\n";
break;
case '2':
echo "A data e hora atuais são: " . date('d/m/Y H:i:s') . "\n";
break;
case '3':
echo "Saindo do programa. Até mais!\n";
break 2;
default:
echo "Opção inválida. Por favor, escolha 1, 2 ou 3.\n";
break;}
echo "---------------------\n"; 
}
echo "O programa foi finalizado.\n";

?>