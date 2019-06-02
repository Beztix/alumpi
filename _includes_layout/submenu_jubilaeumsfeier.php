<?php

//======================================================================
// Diese PHP-Datei enthält das Sub-Navigationsmenü der Seite Absolventenfeier, das von der Datei navigation.php
// bei Bedarf eingebunden wird.
// Über die in der index.php belegten PHP-Variable thisPage wird die aktuelle Seite identifiziert, ihr wird eine 
// entsprechende CSS-Klasse zugewiesen um sie mittels CSS hervorheben zu können.
//======================================================================

//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}


//Unterseiten zur Anmeldung werden nur angezeigt wenn die Anmeldung aktiv ist
if(JUBILAEUMSFEIER_ANMELDUNG_AKTIV) {
	?>
	<ul>
		<li>
			<a <?php if ($thisPage=="jubilaeumsfeier_anmeldeinformationen") {echo " class=\"currentpage\"";} ?>  href="../jubilaeumsfeier_anmeldeinformationen/index.php">Anmeldung Jubiläumsball</a>
		</li>
		<li>
			<a <?php if ($thisPage=="jubilaeumsfeier_anmeldung_gast") {echo " class=\"currentpage\"";} ?>  href="../jubilaeumsfeier_anmeldung_gast/index.php">Festaktkarten</a>
		</li>
		<li>
			<a <?php if ($thisPage=="jubilaeumsfeier_anmeldung_laufkarte") {echo " class=\"currentpage\"";} ?>  href="../jubilaeumsfeier_anmeldung_laufkarte/index.php">Laufkarten</a>
		</li>
		<li>
			<a <?php if ($thisPage=="jubilaeumsfeier_anmeldung_absolvent") {echo " class=\"currentpage\"";} ?>  href="../jubilaeumsfeier_anmeldung_absolvent/index.php">Festaktkarten (Absolvent)</a>
		</li>
	</ul>
	<?php
}
?>