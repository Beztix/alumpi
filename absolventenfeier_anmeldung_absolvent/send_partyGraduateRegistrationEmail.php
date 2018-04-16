<?php

//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}


require_once '../_includes_functionality/phpmailer/PHPMailerAutoload.php';


function send_partyGraduateRegistration_email($toEmail, $titleAndName, $datum_der_feier, $anzahl_gaeste, $gesamtpreis) {
	
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

vielen Dank für ihre Anmeldung zur Absolventenfeier am " . $datum_der_feier . " als aktueller Absolvent. 
Diese E-Mail dient lediglich der Bestätigung der Anmeldung.

Sie haben zusätzlich " . $anzahl_gaeste . " Gäste mit angemeldet. 
Bitte überweisen Sie den Betrag von insgesamt " . $gesamtpreis . " € bis spätestens 7 Tage vor der Feier auf das Konto des Absolventenvereins.

Kontodaten:
Absolventen- und Förderverein MPI Uni Bayreuth e.V.
IBAN: DE05 7735 0110 0038 0189 41
BIC: BYLADEM1SBT
Verwendungszweck: [Nachname],[Vorname]

Bitte denken Sie daran, uns ein Portraitfoto von Ihnen für die Abschlusspräsentation per E-Mail zu schicken.

Falls Sie Fragen haben oder sich nicht für die Feier angemeldet haben, schreiben Sie uns bitte unter alumpi@uni-bayreuth.de .
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