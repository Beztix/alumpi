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
						$thisPage=="absolventenfeier_anmeldeinformationen" || 
						$thisPage=="absolventenfeier_anmeldung_absolvent" || 
						$thisPage=="absolventenfeier_anmeldung_gast" || 
						$thisPage=="absolventengalerie") {
						include 'submenu_absolventenfeier.php';
					}
					?>
				</li>

                <li>
                    <a <?php if ($thisPage=="ehemaligen_treffen") {echo " class=\"currentpage\"";} ?>  href="../ehemaligen_treffen/index.php">Ehemaligentreffen</a>
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
					<h4>Samstag, 23. Juni 2018</h4>
					Absolventenfeier<br>
				</div>
				<!--
				<div class="sidebar-termin">
					Werden bekanntgegeben
				</div>
				-->
				<h3>Sitzungen</h3>
				
				Unsere Sitzungen finden in der Regel alle zwei Wochen dienstags um 18:15 Uhr im S&nbsp;78 im NW2 statt.
				<br>
				Wir freuen uns über eine rege Beteiligung!
				<br>
				<br>
				
				Nächste Sitzungstermine:<br><br>
				Di. 17.04, 18:15<br>
				Do. 03.05, 18:15<br>
				Di. 15.05, 18:15<br>
				Di. 29.05, 18:15<br>
				Di. 12.06, 18:15<br>
				Di. 19.06, 18:15<br>
				Di. 26.06, 18:15<br>
				Di. 10.07, 18:15<br>
				
				
				<br><br>
				Weitere Termine werden bekanntgegeben.

				<h3>Kontakt</h3>
				Universität Bayreuth<br>
				Postfach aluMPI<br>
				Gebäude NWII<br>
				95440 Bayreuth<br>

				<a href="mailto:alumpi@uni-bayreuth.de" class="kontakt-link">alumpi@uni-bayreuth.de</a>
				<a href="https://facebook.com/aluMPI" class="kontakt-link" target="_blank">Facebook-Seite</a>
			</div>
		</div>
		