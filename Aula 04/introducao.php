<?php 
//modelagem de dados sem a ultilização de POD(programação orientada objeto)

$marca_carro1 = "Honda";
$modelo_carro1 = "Civic";
$ano_carro1 = "2016";
$revisao_carro1 = true;
$donos_carro1 = 2;


$marca_carro2 = "BMW";
$modelo_carro2 = "320i";
$ano_carro2 = "2012";
$revisao_carro2 = true;
$donos_carro2 = 5;


$marca_carro3 = "FIAT";
$modelo_carro3 = "uno";
$ano_carro3 = "2005";
$revisao_carro3 = false;
$donos_carro3 = 1;


$marca_carro4 = "volkswagen";
$modelo_carro4 = "jetta";
$ano_carro4 = "2020";
$revisao_carro4 = true;
$donos_carro4 = 7;

function revisaofeita($rev) {
$rev = true;
return $rev;

}

 $revisao_carro3 = revisaofeita($revisao_carro3); //resultado true

 function novodono($quantidade_donos) {
return $quantidade_donos+1;
 }
$donos_carro4 = novodono($donos_carro4);


?>