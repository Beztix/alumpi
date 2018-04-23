<?php

//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}


require_once '../_includes_functionality/phpmailer/PHPMailerAutoload.php';


function send_verificationEmail_memberRegistration($toEmail, $titleAndName, $verificationCode, $student) {
	
	$mail = new PHPMailer;
	
	$mail->CharSet = 'UTF-8';
	
	//Empfänger
	$mail->addAddress($toEmail);  
	
	//Absender
	$mail->setFrom('noreply@alumpi.de', 'aluMPI');           
	$mail->addReplyTo('alumpi@uni-bayreuth.de', 'aluMPI');
	
	//Betreff der Email
	$mail->Subject = 'Registrierung bei AluMPI | Bestätigung des Accounts';
	

	//Inhalt der Email
	$message =  "
Hallo " . $titleAndName . ",

die E-Mail-Adresse dieses Accounts wurde bei der Anmeldung zum Absolventen- und Förderverein MPI Uni Bayreuth e.V. angegeben. 
Wollen Sie Mitglied dieses Vereins werden und bestätigen die Richtigkeit der angegebenen Daten, so klicken Sie bitte auf folgenden Link:

" . 'https://alumpi.de/email_verifikation/index.php?email=' .$toEmail. '&verificationCode='. $verificationCode ."


Wenn es Ihnen nicht möglich ist, den angezeigten Link anzuwählen, kopieren Sie ihn bitte in die Adressleiste Ihres Browsers und drücken Sie \"Enter\". Erhalten Sie bei Klicken des Links oder auch nach Kopieren des Links keine bestätigende Seite, wenden Sie sich bitte an alumpi@uni-bayreuth.de


Sobald Sie als Mitglied bestätigt sind, können Sie sich auf der Seite im Mitgliederbereich mit dieser Email-Adresse und Ihrem Geburstag in der Form TT.MM.JJJJ als Passwort einloggen.
Im internen Bereich können Sie sich für die Absolventenfeier anmelden und Ihre Daten einsehen und ändern, bitte ändern Sie schnellstmöglich Ihr Passwort!

";

	if($student == "j") {		
		$message = $message . "
Sie haben außerdem angegeben, Student zu sein und sind somit vom Beitrag befreit. 
Diese Option wird jedoch erst gültig, wenn ein Studentennachweis von diesem oder letzem Semester vorhanden ist. Schicken Sie diesen bitte innerhalb der nächsten Woche an alumpi@uni-bayreuth.de
";
	}
	
	$message = $message . "   
Wurde Ihre E-Mail-Adresse fälschlicherweise angegeben oder möchten Sie aus dem Verein austreten, schreiben Sie bitte eine kurze E-mail an alumpi@uni-bayreuth.de mit der Bitte um Löschung ihrer persönlichen Daten.


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
		echo 'Mailer Error: ' . $mail->ErrorInfo;
		return false;
	} 
	else {
		return true;
}

}

?>