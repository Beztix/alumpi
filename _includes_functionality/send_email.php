<?php

//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}





function send_verificationEmail_memberRegistration($toEmail, $titleAndName, $verificationCode, $student) {
	
	//Betreff der Email
	$subject = 'Registrierung bei AluMPI | Bestätigung des Accounts';
	
	
	//Inhalt der Email
	$message = "
Hallo " . $titleAndName . ",

die E-Mail-Adresse dieses Accounts wurde bei der Anmeldung zum Absolventen- und Förderverein MPI Uni Bayreuth e.V. angegeben. 
Wollen Sie Mitglied dieses Vereins werden und bestätigen die Richtigkeit der angegebenen Daten, so klicken Sie bitte auf folgenden Link:

" . 'http://btfmx5.fs.uni-bayreuth.de/email_verifikation/index.php?email=' .$toEmail. '&verificationCode='. $verificationCode ."


Wenn es Ihnen nicht möglich ist, den angezeigten Link anzuwählen, kopieren Sie ihn bitte in die Adressleiste Ihres Browsers und drücken Sie Enter. Erhalten Sie bei Klicken des Links oder auch nach Kopieren des Links keine bestätigende Seite, wenden Sie sich bitte an alumpi@uni-bayreuth.de


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
Wurde Ihre E-mailadresse fälschlicherweise angegeben oder möchten Sie aus dem Verein austreten, schreiben Sie bitte eine kurze E-mail an alumpi@uni-bayreuth.de mit der Bitte um Löschung ihrer persönlichen Daten.


Viele Grüße,
Ihr Vorstand von AluMPI

_________________________________________
Absolventen- und Förderverein MPI Uni Bayreuth e.V.
Postfach AluMPI
Gebäude NWII
95440 Bayreuth

alumpi@uni-bayreuth.de
www.alumpi.uni-bayreuth.de
";
	 
	//Header-Informationen	
	$headers   = array();
	$headers[] = "MIME-Version: 1.0";
	$headers[] = "Content-type: text/plain; charset=utf-8";
	$headers[] = "From: noreply@alumpi.uni-bayreuth.de";
	$headers[] = "Subject: {$subject}";
	$headers[] = "X-Mailer: PHP/".phpversion();

	
	//Mail abschicken
	if(mail($toEmail, $subject, $message, implode("\r\n",$headers))) {
		return TRUE;
	} 
	else {
		return FALSE;
	}
										
}
							








function send_notificationEmail_memberRegistration($userEmail, $titleAndName, $student) {
	
	//Email an den Verein
	$toEmail = 'alumpi@uni-bayreuth.de';
	
	//Betreff der Email
	$subject = 'Neue Registrierung bei AluMPI';
	
	
	//Inhalt der Email
	$message = "
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
	 
	//Header-Informationen	
	$headers   = array();
	$headers[] = "MIME-Version: 1.0";
	$headers[] = "Content-type: text/plain; charset=utf-8";
	$headers[] = "From: noreply@alumpi.uni-bayreuth.de";
	$headers[] = "Subject: {$subject}";
	$headers[] = "X-Mailer: PHP/".phpversion();
	
	//Mail abschicken
	if(mail($toEmail, $subject, $message, implode("\r\n",$headers))) {
		return TRUE;
	} 
	else {
		return FALSE;
	}
										
}		








function send_passwordReset_email($toEmail, $resetCode) {
	
	//Betreff der Email
	$subject = 'AluMPI | Zurücksetzen des Passworts';
	
	
	//Inhalt der Email
	$message = "
Hallo,

die E-Mail-Adresse dieses Accounts wurde angegeben, um das Passwort für die Webseite Absolventen- und Fördervereins MPI Uni Bayreuth e.V. zurückzusetzen.
Falls Sie ihr Passwort zurücksetzen möchten, so klicken Sie bitte auf folgenden Link:

" . 'http://btfmx5.fs.uni-bayreuth.de/passwort_zuruecksetzen/index.php?email=' .$toEmail. '&verificationCode='. $resetCode ."


Wenn es Ihnen nicht möglich ist, den angezeigten Link anzuwählen, kopieren Sie ihn bitte in die Adressleiste Ihres Browsers und drücken Sie Enter. Erhalten Sie bei Klicken des Links oder auch nach Kopieren des Links keine bestätigende Seite, wenden Sie sich bitte an alumpi@uni-bayreuth.de


Wurde Ihre E-mailadresse fälschlicherweise angegeben, so schreiben Sie bitte eine kurze E-Mail an alumpi@uni-bayreuth.de .


Viele Grüße,
Ihr Vorstand von AluMPI

_________________________________________
Absolventen- und Förderverein MPI Uni Bayreuth e.V.
Postfach AluMPI
Gebäude NWII
95440 Bayreuth

alumpi@uni-bayreuth.de
www.alumpi.uni-bayreuth.de
";
	 
	//Header-Informationen	
	$headers   = array();
	$headers[] = "MIME-Version: 1.0";
	$headers[] = "Content-type: text/plain; charset=utf-8";
	$headers[] = "From: noreply@alumpi.uni-bayreuth.de";
	$headers[] = "Subject: {$subject}";
	$headers[] = "X-Mailer: PHP/".phpversion();

	
	//Mail abschicken
	if(mail($toEmail, $subject, $message, implode("\r\n",$headers))) {
		return TRUE;
	} 
	else {
		return FALSE;
	}
										
}









function send_partyGraduateRegistration_email($toEmail, $titleAndName, $datum_der_feier, $will_kontoeinzug) {
	
	//Betreff der Email
	$subject = 'Ihre Anmeldung zur Absoventenfeier';
	
	
	//Inhalt der Email
	$message = "
Hallo " . $titleAndName . ",

vielen Dank für ihre Anmeldung zur Absolventenfeier am " . $datum_der_feier . " als aktueller Absolvent. 
Diese E-Mail dient lediglich der Bestätigung der Anmeldung, sie können die von Ihnen angegeben Informationen auf der Webseite unter http://btfmx5.uni-bayreuth.de/anmeldung_feier_absolvent/index.php einsehen.
";

	if($will_kontoeinzug == "j") {		
		$message = $message . "
Sie haben angegeben, dass Sie den Eintritt per Bankeinzug bezahlen möchten, dieser wird ca. eine Woche vor der Feier von ihrem Konto abgebucht. 
";
	}
	
	$message = $message . "   
Falls Sie Fragen haben oder sich nicht für die Feier angemeldet haben, schreiben Sie und bitte unter alumpi@uni-bayreuth.de .
Wir freuen uns auf Ihre Teilnahme an der diesjährigen Absolventenfeier!


Viele Grüße,
Ihr Vorstand von AluMPI

_________________________________________
Absolventen- und Förderverein MPI Uni Bayreuth e.V.
Postfach AluMPI
Gebäude NWII
95440 Bayreuth

alumpi@uni-bayreuth.de
www.alumpi.uni-bayreuth.de
";
	 
	//Header-Informationen	
	$headers   = array();
	$headers[] = "MIME-Version: 1.0";
	$headers[] = "Content-type: text/plain; charset=utf-8";
	$headers[] = "From: noreply@alumpi.uni-bayreuth.de";
	$headers[] = "Subject: {$subject}";
	$headers[] = "X-Mailer: PHP/".phpversion();

	
	//Mail abschicken
	if(mail($toEmail, $subject, $message, implode("\r\n",$headers))) {
		return TRUE;
	} 
	else {
		return FALSE;
	}
										
}		








function send_partyGuestRegistration_email($toEmail, $titleAndName, $datum_der_feier) {
	
	//Betreff der Email
	$subject = 'Ihre Anmeldung zur Absoventenfeier';
	
	
	//Inhalt der Email
	$message = "
Hallo " . $titleAndName . ",

vielen Dank für ihre Anmeldung zum Buffet der Absolventenfeier am " . $datum_der_feier . ". 
Diese E-Mail dient der Bestätigung der Anmeldung.
 
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
www.alumpi.uni-bayreuth.de
";
	 
	//Header-Informationen	
	$headers   = array();
	$headers[] = "MIME-Version: 1.0";
	$headers[] = "Content-type: text/plain; charset=utf-8";
	$headers[] = "From: noreply@alumpi.uni-bayreuth.de";
	$headers[] = "Subject: {$subject}";
	$headers[] = "X-Mailer: PHP/".phpversion();

	
	//Mail abschicken
	if(mail($toEmail, $subject, $message, implode("\r\n",$headers))) {
		return TRUE;
	} 
	else {
		return FALSE;
	}
										
}				
									
									
								

?>