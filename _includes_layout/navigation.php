<?php

//======================================================================
// Diese PHP-Datei enthält das Navigationsmenü der Webseite, das auf jeder Seite der Homepage enthalten ist.
// Sie wird von der jeweiligen index.php eingebunden. 
// Über die in der index.php belegten PHP-Variable thisPage wird die aktuelle Seite identifiziert, ihr wird eine 
// entsprechende CSS-Klasse zugewiesen um sie mittels CSS hervorheben zu können.
// Bei Bedarf werden entsprechende Submenüs eingebunden.
//======================================================================

//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}



?>		




		<div id="navigation">
			<ul>
				<li>
					<a <?php if ($thisPage=="startseite") {echo " class=\"currentpage\"";} ?>  href="../startseite/index.php">Startseite</a>
				</li>
				
				<li>
					<a <?php if ($thisPage=="aktuelles") {echo " class=\"currentpage\"";} ?>  href="../aktuelles/index.php">Aktuelles</a>
				</li>
				
				<li>
					<a <?php if ($thisPage=="absolventenfeier") {echo " class=\"currentpage\"";} ?> href="../absolventenfeier/index.php">Absolventenfeier</a>
					<?php
					//Submenü wird nur angezeigt wenn sich der Nutzer auf dieser Seite oder einer Unterseite befindet
					if($thisPage=="absolventenfeier" || 
						$thisPage=="anmeldung_absolventenfeier" || 
						$thisPage=="anmeldung_feier_gast" || 
						$thisPage=="absolventengalerie") {
						include 'submenu_absolventenfeier.php';
					}
					?>
				</li>
				
				<li>
					<a <?php if ($thisPage=="mitgliedsantrag") {echo " class=\"currentpage\"";} ?> href="../mitgliedsantrag/index.php">Mitgliedsantrag</a>
				</li>
				
				<li>
					<a <?php if ($thisPage=="mitgliederbereich") {echo " class=\"currentpage\"";} ?> href="../mitgliederbereich/index.php">Mitgliederbereich</a>
					<?php
					//Submenü des Mitgliederbereichs wird nur angezeigt wenn der Nutzer eingelogged ist
					if (!empty($_SESSION['login'])) {				
						include 'submenu_mitgliederbereich.php';
					} 
					?>
				</li>
				
				<li>
					<a <?php if ($thisPage=="kontakt") {echo " class=\"currentpage\"";} ?> href="../kontakt/index.php">Kontakt</a>
				</li>
			</ul>

			<div class="sidebar-informationen">
				<h3>Termine</h3>
				<div class="sidebar-termin">
					<h4>Samstag, 17. Juni 2017</h4>
					Absolventenfeier
				</div>
				<div class="sidebar-termin">
					<h4>Freitag, 07. Juli 2017</h4>
					Ehemaligentreffen und Berufsorientierung
				</div>

				<h3>Sitzungen</h3>
				Unsere Sitzungen finden alle zwei Wochen dienstags um 18:00 Uhr im Fachschafts-zimmer im NW2 statt.
				Wir freuen uns über eine rege Beteiligung!
				<br>
				<br>
				Sitzungstermine im SS 2017:<br>
				01., 08., 29. Juni<br>
				06. Juli<br>
				<br>
				Weitere Termine werden bekanntgegeben.

				<h3>Kontakt</h3>
				Postfach aluMPI<br>
				Gebäude NWII<br>
				95440 Bayreuth<br>

				<a href="mailto:alumpi@uni-bayreuth.de" class="kontakt-link">alumpi@uni-bayreuth.de</a>
				<a href="https://facebook.com/aluMPI" class="kontakt-link" target="_blank">Facebook-Seite</a>
			</div>
		</div>
		