<?php 

namespace Aula_10;

class Email {
public function enviar() {
return "Eviando email...";
}
}

class SMS {
public function enviar() {
return "Enviando SMS...";
}
}

function notificar($meio) {
echo $meio->enviar(). "\n";
}

$email = new Email();
$sms = new SMS();

notificar($email);
notificar($sms);


?>