<?php

//======================================================================
// Diese PHP-Datei enthält die Menüpunkte des Sub-Navigationsmenü der Seite Absolventenfeier, die nur bei aktuell freigeschalteter
// Anmeldung angezeigt werden. Bei Bedarf werden sie von der Datei submenu_absolventenfeier.php eingebunden.
// Über die in der index.php belegten PHP-Variable thisPage wird die aktuelle Seite identifiziert, ihr wird eine 
// entsprechende CSS-Klasse zugewiesen um sie mittels CSS hervorheben zu können.
//======================================================================

//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}


?>	
	<li>
		<a <?php if ($thisPage=="absolventenfeier_anmeldung_absolvent") {echo " class=\"currentpage\"";} ?> href="../absolventenfeier_anmeldung_absolvent/index.php">Anmeldung als Absolvent</a>
	</li>
	<li>
		<a <?php if ($thisPage=="absolventenfeier_anmeldung_gast") {echo " class=\"currentpage\"";} ?> href="../absolventenfeier_anmeldung_gast/index.php">Anmeldung als Gast</a>
	</li>