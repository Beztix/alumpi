<?php

//======================================================================
// Diese PHP-Datei dient der Authentifizierung. 
// Sie muss von jeder Seite eingebunden wurden, die gegen den Zugriff nicht eingeloggter Nutzer gesch�tzt werden soll.
//======================================================================



	//Session ID erneuern um Angriff �ber Session Fixation zu verhindern
	session_regenerate_id();
 
	//Wenn die Session-Variable "login" f�r den aktuellen User nicht gesetzt wurde, ist dieser nicht eingeloggt: Weiterleiten auf die Login-Seite
	if (empty($_SESSION['login'])) {
		header('Location: ../mitgliederbereich/index.php');
		exit;
	}
?>