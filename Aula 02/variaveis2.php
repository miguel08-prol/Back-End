<?php 
#Atividade 1

// $aluno = readline("Digite o nome do aluno: "); #readline é um imput
// $falta = readline("Digite as faltas do aluno: ");

// $letivo = 200 - $falta;
// $frequencia = ($letivo / 200) * 100;


// $P1 = readline("Digite a 1° nota do aluno: ");
// $Participação = readline("Digite a nota de participação do aluno: ");
// $APP = readline("Digite a nota de app do aluno: ");
// $Provão = readline("Digite a nota do provão: ");

// $soma = $P1 + $Participação + $APP + $Provão;
// $media = $soma / 4;

// if ($media >= 7 & $frequencia >= 75) {echo "$aluno: aprovado \nMédia: $media \nFrequência: $frequencia%";} else {echo "$aluno: Reprovado \nMédia: ",$media,"\nFrequência: $frequencia%";}

?>

<?php 
# Atividade 2

$aluno = readline("Digite o nome do aluno: ");
$falta = readline("Digite as faltas do aluno: ");
$letivo = 200 - $falta;
$frequencia = ($letivo / 200) * 100;


$P1 = readline("Digite a 1° nota do aluno: ");
$Participação = readline("Digite a nota de participação do aluno: ");
$APP = readline("Digite a nota de app do aluno: ");
$Provão = readline("Digite a nota do provão: ");

$soma = $P1 + $Participação + $APP + $Provão;
$media = $soma / 4;

if ($media >= 7 & $frequencia >= 75) {echo "$aluno: aprovado \nMédia: $media \nFrequência: $frequencia%";}else if ($aluno == "Enzo Enrico") {echo "$aluno: aprovado \nMédia: $media \nFrequência: $frequencia%";} else {echo "$aluno: Reprovado \nMédia: ",$media,"\nFrequência: $frequencia%";}


?> 