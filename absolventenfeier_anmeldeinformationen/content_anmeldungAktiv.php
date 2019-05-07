<?php
//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}
?>

				<p>
				Auf dieser Seite finden Sie alle Informationen zur Anmeldung zur Absolventenfeier.
				Die Absolventenfeier ist als Fakultätsfeier zur Ehrung der Absolventen konzipiert, es sind neben den Absolventen selbst und ihren Gästen explizit auch alle Fakultätsangehörigen und ehemaligen Absolventen herzlich eingeladen!<br>
				<br>
				<strong>Die nächste Absolventenfeier findet am <?php echo ABSOLVENTENFEIER_DATUM; ?> statt.</strong><br>
				<br>
				Die Anmeldung gestaltet sich unterschiedlich, je nachdem ob Sie selbst aktueller Absolvent sind und ob Sie am Buffet teilnehmen möchten oder nicht:
				</p>
				<br>
				
				
				<a name="absolvent"></a>
				<h2>Sie sind aktueller Absolvent oder Gast eines aktuellen Absolventen?</h2>
				
				<p>
				Um als aktueller Absolvent an der Absolventenfeier teilzunehmen, besuchen Sie bitte die folgende Anmeldeseite: <br>
				<a href="../absolventenfeier_anmeldung_absolvent/index.php">Zur Anmeldung als Absolvent</a><br>
				<br>
				Im Gegensatz zu den vergangenen Jahren ist die Mitgliedschaft im Absolventenverein nicht zwingend erforderlich, wir würden uns aber natürlich sehr freuen wenn Sie sich zusammen mit der Anmeldung zur Feier auch als Mitglied des Absolventenvereins anmelden würden.<br>
				Als aktueller Absolvent sind Sie der Mittelpunkt dieser Veranstaltung und können Ihren Abschluss in einem festlichen Rahmen feiern.
				Sie erhalten im Rahem des Festakts Ihre Abschlussurkunde, die vom Dekan überreicht wird.
				Zusätzlich gibt es ein kleines Abschlussgeschenk des Absolventenvereins, Sie werden an der Absolventenwand unserer Fakultät verewigt und es gibt ausreichend Gelegenheiten für schöne Erinnerungsfotos.<br>
				<br>
				Gäste der aktuellen Absolventen können von diesen mit angemeldet werden und müssen somit <strong>keine</strong> separate Anmeldung durchführen!<br>
				<br>
				Die Teilnahme an der Feier incl. Buffet kostet pro Person <?php echo ABSOLVENTENFEIER_PREIS; ?>€.<br>
				</p>
				<br>
				<br>

				<!--
				Diese ist für Studenten und aktuelle Absolventen kostenlos, Sie profitieren mit der Anmeldung zum Absolventenverein auch als beitragsbefreites Mitglied von den <a href="../mitgliedsantrag/index.php">Vorteilen der Mitgliedschaft</a>.<br>
				<br>
				Gäste der aktuellen Absolventen können von diesen mit angemeldet werden und müssen somit <strong>keine</strong> separate Anmeldung durchführen!<br>
				<br>
				Die Teilnahme an der Feier incl. Buffet kostet pro Person <?php echo ABSOLVENTENFEIER_PREIS; ?>€.<br>
				<br>
				Als aktueller Absolvent sind Sie der Mittelpunkt dieser Veranstaltung und können Ihren Abschluss in einem festlichen Rahmen feiern.
				Sie erhalten im Anschluss an die Festrede Ihre Abschlussurkunde, die vom Dekan überreicht wird.
				Zusätzlich gibt es ein kleines Abschlussgeschenk des Absolventenvereins, Sie werden an der Absolventenwand unserer Fakultät verewigt und es gibt ausreichend Gelegenheiten für schöne Erinnerungsfotos.<br>
				<br>
				<br>
				Falls Sie bereits Vereinsmitglied sind, loggen Sie sich bitte im <a href="../mitgliederbereich/index.php">Mitgliederbereich</a> ein, um dort ihre Anmeldung zur Absolventenfeier als aktueller Absolvent durchzuführen.<br>
				<br>
				Sollten Sie noch kein Vereinsmitglied sein, so melden Sie sich bitte auf über den <a href="../mitgliedsantrag/index.php">Mitgliedsantrag</a> als Mitglied des Absolventenvereins an.
				Dies ist im ersten Jahr für Sie kostenlos, die Mitgliedschaft ist jahresweise kündbar.<br>
				Anschließend können Sie sich im Mitgliederbereich als aktueller Absolvent zur Feier anmelden.
				</p>
				<br>
				-->
				
				<a name="gast"></a>
				<h2>Sie sind Fakultätsangehöriger oder eigenständiger Gast?</h2>
				
				
				<p>
				Wir freuen uns sehr, dass Sie an der diesjährigen Feier teilnehmen möchten.<br>
				Falls Sie lediglich am offiziellen Festakt und nicht an den anschließenden Feierlichkeiten mit Buffet teilnehmen möchten, so ist dafür keine Anmeldung nötig.
				Die Feier beginnt um <?php echo ABSOLVENTENFEIER_UHRZEIT; ?> im <?php echo ABSOLVENTENFEIER_ORT; ?>, wir freuen uns darauf Sie dort Begrüßen zu dürfen.<br>
				</p>
				
				<h3>Teilnahme an den anschließenden Feierlichkeiten</h3>
				
				<p>
				Falls Sie zusätzlich an den Feierlichkeiten inklusive Buffet nach dem offiziellen Festakt teilnehmen möchten, so benötigen wir eine vorherige verbindliche Anmeldung, um das Catering entsprechend planen zu können.<br>
				Die Teilnahme an der Feier incl. Buffet kostet pro Person <?php echo ABSOLVENTENFEIER_PREIS; ?> €, mit diesem Beitrag helfen Sie uns dabei neben den Kosten für das Buffet auch die sonstigen Kosten der Veranstaltung decken zu können.<br>
				<br>
				Wenn Sie Gast eines der feiernden Absolventen sind, so lassen Sie sich bitte von diesem mit anmelden, dann ist keine separate Anmeldung ihrerseits nötig.
				Andernfalls füllen Sie bitte das entsprechende Anmeldeformular aus, um am Buffet teilzunehmen:<br>
				<a href="../anmeldung_feier_gast/index.php">Zum Anmeldeformular für die Feierlichkeiten als separater Gast</a>
				</p>