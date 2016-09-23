<?php

//======================================================================
// Diese PHP-Datei enthält das Sub-Navigationsmenü des Mitgliederbereichs, das von der Datei naviagtion.php
// bei Bedarf eingebunden wird.
// Über die in der index.php belegten PHP-Variable thisPage wird die aktuelle Seite identifiziert, ihr wird eine 
// entsprechende CSS-Klasse zugewiesen um sie mittels CSS hervorheben zu können.
//======================================================================

//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}


include_once '../_includes_functionality/calculateAccessPermissions.php';

?>	

<ul>
	<li>
		<a <?php if ($thisPage=="anmeldung_feier_absolvent") {echo " class=\"currentpage\"";} ?> href="../anmeldung_feier_absolvent/index.php">Anmeldung zur Absolventenfeier</a>
	</li>
	<li>
		<a <?php if ($thisPage=="bildergalerie") {echo " class=\"currentpage\"";} ?> href="../bildergalerie/index.php">Bildergalerie</a>
	</li>
	<li>
		<a <?php if ($thisPage=="datenabfrage") {echo " class=\"currentpage\"";} ?> href="../datenabfrage/index.php">Datenabfrage</a>
	</li>
	<li>
		<a <?php if ($thisPage=="downloads") {echo " class=\"currentpage\"";} ?> href="../downloads/index.php">Downloads</a>
	</li>
	
<?php
//Menuepunkte nur anzeigen, wenn angemeldeter Nutzer passende Zugriffsrechte hat


//Wer Zugriff haben soll in den Argumenten: foerderer, mitglied, orga, kuratorium, finanzer, vorstand, admin
if(doesCurrentUserHaveAccess(False, False, False, False, True, True, True)) {
	echo "<li>\n";
	echo "<a ";
	if($thisPage=="mitgliedersuche") {echo " class=\"currentpage\"";}
	echo "href=\"../mitgliedersuche/index.php\">Mitgliedersuche</a>\n";
	echo "</li>\n";
}

//Wer Zugriff haben soll in den Argumenten: foerderer, mitglied, orga, kuratorium, finanzer, vorstand, admin
if(doesCurrentUserHaveAccess(False, False, False, False, False, True, True)) {
	echo "<li>\n";
	echo "<a ";
	if($thisPage=="vorstandsfunktionen") {echo " class=\"currentpage\"";}
	echo "href=\"../vorstandsfunktionen/index.php\">Vorstandsfunktionen</a>\n";
	echo "</li>\n";
}

//Wer Zugriff haben soll in den Argumenten: foerderer, mitglied, orga, kuratorium, finanzer, vorstand, admin
if(doesCurrentUserHaveAccess(False, False, False, False, True, True, True)) {
	echo "<li>\n";
	echo "<a ";
	if($thisPage=="finanzerfunktionen") {echo " class=\"currentpage\"";}
	echo "href=\"../finanzerfunktionen/index.php\">Finanzerfunktionen</a>\n";
	echo "</li>\n";
}

//Wer Zugriff haben soll in den Argumenten: foerderer, mitglied, orga, kuratorium, finanzer, vorstand, admin
if(doesCurrentUserHaveAccess(False, False, True, True, True, True, True)) {
	echo "<li>\n";
	echo "<a ";
	if($thisPage=="orgafunktionen") {echo " class=\"currentpage\"";}
	echo "href=\"../orgafunktionen/index.php\">Orga-Team-Funktionen</a>\n";
	echo "</li>\n";
}


?>
	
	
	
	
	
	<li>
		<a <?php if ($thisPage=="logout") {echo " class=\"currentpage\"";} ?> href="../logout/index.php">Logout</a>
	</li>
</ul>

