<?php 
#Atividade 1

// $aluno = "Miguel";
// $falta = 43;

// $letivo = 200 - $falta;
// $frequencia = ($letivo / 200) * 100;


// $P1 = 10;
// $Participação = 10;
// $APP = 3;
// $Provão = 6;

// $soma = $P1 + $Participação + $APP + $Provão;
// $media = $soma / 4;

// if ($media >= 7 & $frequencia >= 75) {echo "$aluno: aprovado \nMédia: $media \nFrequência: $frequencia%";} else {echo "$aluno: Reprovado \nMédia: ",$media,"\nFrequência: $frequencia%";}

?>

<?php 
# Atividade 2

$aluno = "Enzo Enrico";
$falta = 199;

$letivo = 200 - $falta;
$frequencia = ($letivo / 200) * 100;


$P1 = 1;
$Participação = 5;
$APP = 3;
$Provão = 6;

$soma = $P1 + $Participação + $APP + $Provão;
$media = $soma / 4;

if ($media >= 7 & $frequencia >= 75) {echo "$aluno: aprovado \nMédia: $media \nFrequência: $frequencia%";}else if ($aluno == "Enzo Enrico") {echo "$aluno: aprovado \nMédia: $media \nFrequência: $frequencia%";} else {echo "$aluno: Reprovado \nMédia: ",$media,"\nFrequência: $frequencia%";}


?>