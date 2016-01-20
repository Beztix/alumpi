<?php





function send_verification_email($toEmail, $titleAndName, $verificationCode, $student) {
	
	//Betreff der Email
	$subject = 'Registrierung bei AluMPI | Bestätigung des Accounts';
	
	
	//Inhalt der Email
	$message = "
	 	
		Hallo " . $titleAndName . ",\n

		die E-Mail-Adresse dieses Accounts wurde bei der Anmeldung zum Absolventen- und Förderverein MPI Uni Bayreuth e.V. 
        angegeben. Wollen Sie Mitglied dieses Vereins werden und bestätigen die Richtigkeit der angegebenen Daten, so klicken Sie
        bitte auf folgenden Link.\n
		\n
		XXXXX" . $verificationCode . "\n
		\n
        \n      
		Wenn es Ihnen nicht möglich ist, den angezeigten Link anzuwählen, kopieren Sie ihn bitte in die Adressleiste Ihres Browsers 
		und drücken Sie Enter. Erhalten Sie bei Klicken des Links oder auch nach Kopieren des Links keine bestätigende Seite,
		wenden Sie sich bitte an alumpi@uni-bayreuth.de\n
		\n
		
		Sobald Sie als Mitglied bestätigt sind, können Sie sich auf der Seite im Mitgliederbereich mit dieser Email-Adresse und Ihrem 
		Geburstag in der Form TT.MM.JJJJ als Passwort einloggen.\n 
		Im internen Bereich können Sie sich für die Absolventenfeier anmelden und Ihre Daten einsehen und ändern, bitte ändern Sie 
		schnellstmöglich Ihr Passwort!\n
		\n
		";

	if($student == "j") {		
		$message = $message . "
			Sie haben außerdem angegeben, Student zu sein und sind somit vom Beitrag befreit. Diese Option wird jedoch erst gültig, 
			wenn ein Studentennachweis von diesem oder letzem Semester vorhanden ist. Schicken Sie diesen bitte innerhalb der nächsten
			Woche an alumpi@uni-bayreuth.de\n
			";
	}
	
	$message = $message . "
		              
        Wurde Ihre E-mailadresse fälschlicherweise angegeben oder möchten Sie aus dem Verein austreten, schreiben Sie bitte eine kurze 
		E-mail an alumpi@uni-bayreuth.de mit der Bitte um Löschung ihrer persönlichen Daten.\n
		\n
		\n
		Viele Grüße,\n
        Ihr Vorstand von AluMPI\n
        \n
		\n
        _________________________________________\n
		Absolventen- und Förderverein MPI Uni Bayreuth e.V.\n
		Postfach AluMPI\n
		Gebäude NWII\n
		95440 Bayreuth\n
        \n
        alumpi@uni-bayreuth.de\n
        www.alumpi.uni-bayreuth.de\n
        \n
		";
	 
	//Absender-Information	
	$headers = 'From:noreply@alumpi.uni-bayreuth.de' . "\r\n";
	
	//Mail abschicken
	if(mail($toEmail, $subject, $message, $headers)) {
		return TRUE;
	} 
	else {
		return FALSE;
	}
										
}
							








function send_notification_email($userEmail, $titleAndName, $student) {
	
	//Email an den Verein
	$toEmail = 'alumpi@uni-bayreuth.de';
	
	//Betreff der Email
	$subject = 'Neue Registrierung bei AluMPI';
	
	
	//Inhalt der Email
	$message = "
	 	
		Hallo,\n

		" . $titleAndName . " hat sich soeben auf der Webseite zum Verein angemeldet.\n
		Die E-Mail-Adresse lautet " . $userEmail . " \n
		\n
		";

	if($student == "j") {		
		$message = $message . "
			 Das neue Mitglied hat angegeben Student zu sein. Sollte in der nächsten Woche keine Studentenbescheinigung vorliegen, 
			 so erinnern Sie das neue Mitglied daran!\n
			";
	}
	
	$message = $message . "
		              
        Prüfen Sie ob das Mitglied in der Datenbank bestätigt wurde!\n
		\n
		\n
		";
	 
	//Absender-Information	
	$headers = 'From:noreply@alumpi.uni-bayreuth.de' . "\r\n";
	
	//Mail abschicken
	if(mail($toEmail, $subject, $message, $headers)) {
		return TRUE;
	} 
	else {
		return FALSE;
	}
										
}							
									
									
								

?>