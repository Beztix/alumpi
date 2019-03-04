<?php 

//======================================================================

//======================================================================

//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}





//Formulardaten angekommen
if(isset($_POST['inkorrekte_bankdaten'])) {

	//Kontrolldatei für die inkorrekten Bankdaten (ausserhalb des öffentlichen www-verzeichnis!!)
	$file_inkorrekt = HOME_DIRECTORY . 'generated_files/kontrollDatei_inkorrekteBankdaten.csv';
	
	ob_end_clean();
	//Datei an User zum Download ausliefern
	header('Content-Description: File Transfer');
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename='.basename($file_inkorrekt));
	header('Content-Transfer-Encoding: binary');
	header('Expires: 0');
	header('Cache-Control: must-revalidate');
	header('Pragma: public');
	header('Content-Length: ' . filesize($file_inkorrekt));
	ob_end_clean();
	flush();
	readfile($file_inkorrekt);
	exit;

}//eof Formulardaten angekommen




//Formulardaten angekommen
if(isset($_POST['neue_mitglieder'])) {

	//Zu generierende Kontrolldatei für die Mitglieder aus dem aktuellen Jahr (ausserhalb des öffentlichen www-verzeichnis!!)
	$file_newMembers = HOME_DIRECTORY . 'generated_files/kontrollDatei_neueMitglieder.csv';
	
	ob_end_clean();
	//Datei an User zum Download ausliefern
	header('Content-Description: File Transfer');
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename='.basename($file_newMembers));
	header('Content-Transfer-Encoding: binary');
	header('Expires: 0');
	header('Cache-Control: must-revalidate');
	header('Pragma: public');
	header('Content-Length: ' . filesize($file_newMembers));
	ob_end_clean();
	flush();
	readfile($file_newMembers);
	exit;
	
}//eof Formulardaten angekommen




//Formulardaten angekommen
if(isset($_POST['studienbescheinigungen'])) {
	
	//Zu generierende Kontrolldatei für die Mitglieder aus den Vorjahren, die eine Studentenbescheinigung eingereicht haben (ausserhalb des öffentlichen www-verzeichnis!!)
	$file_students = HOME_DIRECTORY . 'generated_files/kontrollDatei_studenten.csv';

	ob_end_clean();
	//Datei an User zum Download ausliefern
	header('Content-Description: File Transfer');
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename='.basename($file_students));
	header('Content-Transfer-Encoding: binary');
	header('Expires: 0');
	header('Cache-Control: must-revalidate');
	header('Pragma: public');
	header('Content-Length: ' . filesize($file_students));
	ob_end_clean();
	flush();
	readfile($file_students);
	exit;

}//eof Formulardaten angekommen






//Formulardaten angekommen
if(isset($_POST['zahler'])) {

	//Zu generierende Kontrolldatei für die Mitglieder von denen eingezogen wird (ausserhalb des öffentlichen www-verzeichnis!!)
	$file_payment = HOME_DIRECTORY . 'generated_files/kontrollDatei_zahler.csv';
			
	ob_end_clean();		
	//Datei an User zum Download ausliefern
	header('Content-Description: File Transfer');
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename='.basename($file_payment));
	header('Content-Transfer-Encoding: binary');
	header('Expires: 0');
	header('Cache-Control: must-revalidate');
	header('Pragma: public');
	header('Content-Length: ' . filesize($file_payment));
	ob_end_clean();
	flush();
	readfile($file_payment);
	exit;

}//eof Formulardaten angekommen




