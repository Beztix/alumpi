<?php

//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}


require_once '../_includes_functionality/phpmailer/PHPMailerAutoload.php';


function send_partyGuestRegistration_email($toEmail, $titleAndName, $datum_der_feier, $preis) {
	
	$mail = new PHPMailer;
	$mail->CharSet = 'UTF-8';
	
	//Empfänger
	$mail->addAddress($toEmail);  
	
	//Absender
	$mail->setFrom('noreply@alumpi.de', 'aluMPI');           
	$mail->addReplyTo('alumpi@uni-bayreuth.de', 'aluMPI');
	
	//Betreff der Email
	$mail->Subject = 'Ihre Anmeldung zur Absoventenfeier';
	

	//Inhalt der Email
	$message =  "
Hallo " . $titleAndName . ",

vielen Dank für ihre Anmeldung zur Absolventenfeier am " . $datum_der_feier . " inklusive Buffetteilnahme. 
Diese E-Mail dient der Bestätigung der Anmeldung.

Bitte überweisen Sie den Betrag von " . $preis . " € bis spätestens 7 Tage vor der Feier auf das Konto des Absolventenvereins.

Kontodaten:
Absolventen- und Förderverein MPI Uni Bayreuth e.V.
IBAN: DE05 7735 0110 0038 0189 41
BIC: BYLADEM1SBT
Verwendungszweck: [Nachname],[Vorname]

 
Falls Sie Fragen haben oder sich nicht für die Feier angemeldet haben, schreiben Sie uns bitte unter alumpi@uni-bayreuth.de.
Wir freuen uns auf Ihre Teilnahme an der diesjährigen Absolventenfeier!


Viele Grüße,
Ihr Vorstand von AluMPI

_________________________________________
Absolventen- und Förderverein MPI Uni Bayreuth e.V.
Postfach AluMPI
Gebäude NWII
95440 Bayreuth

alumpi@uni-bayreuth.de
www.alumpi.de
";

	$mail->Body = $message;


	if(!$mail->send()) {
		return false;
	} 
	else {
		return true;
}

}

?>