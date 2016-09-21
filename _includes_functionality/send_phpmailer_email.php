<?php

//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}


require_once 'phpmailer/PHPMailerAutoload.php';


function send_passwordReset_email($toEmail, $resetCode) {
	
	$mail = new PHPMailer;
	
	//Empf�nger
	$mail->addAddress($toEmail);  
	
	//Absender
	$mail->setFrom('noreply@alumpi.de', 'aluMPI');           
	$mail->addReplyTo('alumpi@uni-bayreuth.de', 'aluMPI');
	
	//Betreff der Email
	$mail->Subject = 'AluMPI | Zur�cksetzen des Passworts TEST TEST TEST';
	

	//Inhalt der Email
	$mail->Body    =  "
Hallo,

die E-Mail-Adresse dieses Accounts wurde angegeben, um das Passwort f�r die Webseite Absolventen- und F�rdervereins MPI Uni Bayreuth e.V. zur�ckzusetzen.
Falls Sie ihr Passwort zur�cksetzen m�chten, so klicken Sie bitte auf folgenden Link:

" . 'https://alumpi.de/passwort_zuruecksetzen/index.php?email=' .$toEmail. '&resetCode='. $resetCode ."


Wenn es Ihnen nicht m�glich ist, den angezeigten Link anzuw�hlen, kopieren Sie ihn bitte in die Adressleiste Ihres Browsers und dr�cken Sie \"Enter\". Erhalten Sie bei Klicken des Links oder auch nach Kopieren des Links keine best�tigende Seite, wenden Sie sich bitte an alumpi@uni-bayreuth.de


Wurde Ihre E-Mail-Adresse f�lschlicherweise angegeben, so schreiben Sie bitte eine kurze E-Mail an alumpi@uni-bayreuth.de .


Viele Gr��e,
Ihr Vorstand von AluMPI

_________________________________________
Absolventen- und F�rderverein MPI Uni Bayreuth e.V.
Postfach AluMPI
Geb�ude NWII
95440 Bayreuth

alumpi@uni-bayreuth.de
www.alumpi.de
";

echo 'trying to send mail<br>';

if(!$mail->send()) {
	echo 'error<br>';
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
	return false;
} 
else {
    echo 'Message has been sent';
	return true;
}

}

?>