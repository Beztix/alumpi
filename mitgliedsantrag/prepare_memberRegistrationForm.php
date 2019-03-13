<?php 

//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}


//Einbinden der Konfigurationsdatei (Passwort etc. für die Datenbank)
include_once HOME_DIRECTORY . 'config-files/db_config.php';

//Zur Datenbank verbinden
$mysqli = @new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$mysqli->set_charset("utf8");

//Fehler bei der DB-Verbindung		
if ($mysqli->connect_errno) {
    echo "<h3 class=\"error\">Fehler bei der Verarbeitung des Formulars:</h3>\n";
    echo "<p class=\"error\">";
    echo "Leider ist aktuell keine Verbindung zur AluMPI-Datenbank möglich!<br>";
    echo "Falls dieses Problem weiterhin auftritt kontaktieren Sie bitte den Homepage-Verantwortlichen, siehe \"Kontakt\"<br>";
    echo "<br>";
    echo "Failed to connect to MySQL<br>";
    echo "</p>";
}

$sql = "SELECT id, `name` FROM branche";
$result = $mysqli->query($sql);
$branchen = array();

while($row = $result->fetch_assoc()) {
    $branchen[] = array("name" => $row["name"], "id" => $row["id"]);
}
