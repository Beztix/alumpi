<?php

//======================================================================
// Diese PHP-Datei dient der Authentifizierung. 
// Sie muss von jeder Seite eingebunden wurden, die gegen den Zugriff nicht eingeloggter Nutzer geschützt werden soll.
//======================================================================



	//Session ID erneuern um Angriff über Session Fixation zu verhindern
	session_regenerate_id();
 
	//Wenn die Session-Variable "login" für den aktuellen User nicht gesetzt wurde, ist dieser nicht eingeloggt: Weiterleiten auf die Login-Seite
	if (empty($_SESSION['login'])) {
		header('Location: ../mitgliederbereich/index.php');
		exit;
	}
?>