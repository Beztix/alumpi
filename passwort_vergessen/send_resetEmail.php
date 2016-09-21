<?php

//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}


require_once '../_includes_functionality/phpmailer/PHPMailerAutoload.php';


function send_passwordReset_email($toEmail, $resetCode) {
	
	$mail = new PHPMailer;
	
	$mail->CharSet = 'UTF-8';
	
	//Empfänger
	$mail->addAddress($toEmail);  
	
	//Absender
	$mail->setFrom('noreply@alumpi.de', 'aluMPI');           
	$mail->addReplyTo('alumpi@uni-bayreuth.de', 'aluMPI');
	
	//Betreff der Email
	$mail->Subject = 'AluMPI | Zurücksetzen des Passworts';
	

	//Inhalt der Email
	$mail->Body    =  "
Hallo,

die E-Mail-Adresse dieses Accounts wurde angegeben, um das Passwort für die Webseite Absolventen- und Fördervereins MPI Uni Bayreuth e.V. zurückzusetzen.
Falls Sie ihr Passwort zurücksetzen möchten, so klicken Sie bitte auf folgenden Link:

" . 'https://alumpi.de/passwort_zuruecksetzen/index.php?email=' .$toEmail. '&resetCode='. $resetCode ."


Wenn es Ihnen nicht möglich ist, den angezeigten Link anzuwählen, kopieren Sie ihn bitte in die Adressleiste Ihres Browsers und drücken Sie \"Enter\". Erhalten Sie bei Klicken des Links oder auch nach Kopieren des Links keine bestätigende Seite, wenden Sie sich bitte an alumpi@uni-bayreuth.de


Wurde Ihre E-Mail-Adresse fälschlicherweise angegeben, so schreiben Sie bitte eine kurze E-Mail an alumpi@uni-bayreuth.de .


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


	if(!$mail->send()) {
		return false;
	} 
	else {
		return true;
}

}

?>