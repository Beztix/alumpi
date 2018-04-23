<?php

//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}


require_once '../_includes_functionality/phpmailer/PHPMailerAutoload.php';


function send_notificationEmail_memberRegistration($userEmail, $titleAndName, $student) {
	
	//Email an den Verein
	$toEmail = 'alumpi@uni-bayreuth.de';
	
	$mail = new PHPMailer;
	$mail->CharSet = 'UTF-8';
	
	//Empfänger
	$mail->addAddress($toEmail);  
	
	//Absender
	$mail->setFrom('noreply@alumpi.de', 'aluMPI');           
	$mail->addReplyTo('alumpi@uni-bayreuth.de', 'aluMPI');
	
	//Betreff der Email
	$mail->Subject = 'Neue Registrierung bei AluMPI';
	

	//Inhalt der Email
	$message =  "
Hallo,

" . $titleAndName . " hat sich soeben auf der Webseite zum Verein angemeldet.
Die E-Mail-Adresse lautet " . $userEmail . "

";

	if($student == "j") {		
		$message = $message . "
Das neue Mitglied hat angegeben Student zu sein. Sollte in der nächsten Woche keine Studentenbescheinigung vorliegen, so erinnern Sie das neue Mitglied daran!
";
	}
	
	$message = $message . "	  
Prüfen Sie ob das Mitglied in der Datenbank bestätigt wurde!
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