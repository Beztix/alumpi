<?php

//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}


require_once 'phpmailer/PHPMailerAutoload.php';


function send_partyLaufkartenRegistration_email($toEmail, $titleAndName, $datum_der_feier, $anzahl_gaeste, $gesamtpreis) {
	
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
Sehr geehrter " . $titleAndName . ",

vielen Dank für ihre Anmeldung zum Jubiläumsball am " . $datum_der_feier . ". 

Diese E-Mail dient lediglich der Bestätigung der Anmeldung.

Sie haben zusätzlich " . $anzahl_gaeste . " Gäste mit angemeldet. 
Bitte überweisen Sie den Betrag von insgesamt " . $gesamtpreis . " € in den kommenden zwei Wochen auf das Konto des Absolventenvereins.

Kontodaten:
Absolventen- und Förderverein MPI Uni Bayreuth e.V.
IBAN: DE05 7735 0110 0038 0189 41
BIC: BYLADEM1SBT
Verwendungszweck: [Nachname],[Vorname]


Falls Sie Fragen oder Änderungswünsche zu Ihrer Buchung haben, schreiben Sie uns bitte unter alumpi@uni-bayreuth.de.

Wir freuen uns auf Ihre Teilnahme!


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