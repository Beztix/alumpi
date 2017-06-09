<?php
//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}
?>


		<section id="content">
		
			<section class="top_image">
				<img src="../_images_content/banner_sektglaeser.jpg" alt="Sektgläser">
			</section>
		
		
			<section class="text">
		
				<?php
				if(ABSOLVENTENFEIER_INFO_AKTIV) {
					
					//<!-- thumbnail image wrapped in a link -->
					echo "<a href=\"#absolventenfeier17plakat\">\n";
					echo 	"<div class=\"right_img_container\">\n";
					echo 		"<img src=\"../_images_content/absolventenfeier2017_plakat_klein.jpg\" alt=\"Plakat Absolventenfeier\" style=\"width:350px;\">\n";
					echo 	"</div>\n";
					echo "</a>\n";
					
					//<!-- lightbox container hidden with CSS -->
					echo "<a href=\"#_\" class=\"lightbox\" id=\"absolventenfeier17plakat\">\n";
					echo 	"<img src=\"../_images_content/absolventenfeier2017_plakat_mittel.jpg\" alt=\"Plakat Absolventenfeier 2017\">\n";
					echo "</a>\n";
					
				}
				?>
		
				<h1>Absolventenfeier</h1>


				<p>
				Eine Reihe von nervösen Studenten steht am Eingang des Hörsaals. Man hört leise Musik spielen, das Foyer ist festlich dekoriert. 
				Man kann das Tippen von fein herausgeputzten Schuhen hören, hochgesteckte Frisuren im Abendlicht schimmern sehen und erkennen, 
				wie den Krawattenknoten der letzten Schliff gegeben wird. <br>
				Studenten? Nicht mehr lange. Hier werden heute neue Absolventen geboren! <br>
				Die letzten Staubkörner werden von den festlichen Kleidern entfernt und schon marschieren sie zum letzten Abenteuer des Studiums.
				</p>
				
				<br>
				<br>
				
				<br>
				<h2>Allgemeine Informationen zur Absolventenfeier</h2>
				
				
				<?php
				if(ABSOLVENTENFEIER_INFO_AKTIV) {
					echo "<p>\n";
					echo "<strong>Die nächste Absolventenfeier findet am " . ABSOLVENTENFEIER_DATUM . " statt.</strong>\n";
					echo "</p>\n";
				}
				else {
					echo "<p>\n";
					echo "Die nächste Absolventenfeier findet voraussichtlich gegen Ende des nächsten Sommersemesters statt, der genaue Termin wird noch bekannt gegeben.\n";
					echo "</p>\n";
				}
				?>
				
				<p>
				<span class='news-important'>Anmeldeschluss verlängert bis zum 10.06.!</span>
				Die Absolventenfeier der Fakultät I bietet den passenden Rahmen um den Abschluss der Absolventen gemeinsam mit ihren Familien, Freunden und Professoren zu feiern. 
				Sie unterteilt sich in zwei Akte, den ersten Teil bildet der Festakt. 
				Dieser beinhaltet einen Festvortrag, anschließend wird jedem Absolvent eine Abschlussurkunde der Fakultät verliehen, 
				während die Absolventen in einer Präsentation kurz vorgestellt werden.<br>
				Im Anschluss daran beginnt der gemütliche Teil, nämlich die Feierlichkeiten mit Buffet, Cocktails der Physikerbar und gemütlichem Beisammensein im Foyer des NWII mit musikalischer Untermalung.<br>
				</p>		

				<div class="left_img_container">
					<img src="../_images_content/deko_absolventenfeier.jpg" alt="Deko Absolventenfeier" style="width:400px;">
				</div>
				
				<p>				
				Während die Verabschiedung und der Festvortrag für jedermann frei zugänglich sind, ist für die gemütlichen Feierlichkeiten eine vorherige Anmeldung nötig.<br> 
				Haben Sie Ihr Studium erst kürzlich abgeschlossen oder bisher noch nicht die Zeit gefunden Ihren Abschluss ausgiebig zu feiern? 
				Dann ergreifen Sie nun die Gelegenheit!
				</p>
				
				
				<?php
				if(ABSOLVENTENFEIER_INFO_AKTIV) {
					echo "<h3>Anmeldefrist</h3>";
					echo "\n";
					echo "<p>\n";
					echo "Um das Buffet zu planen und die Urkunden und Absolventengeschenke vorbereiten zu können, ist eine rechtzeitige Anmeldung erforderlich.\n";
					echo "Der aktuelle Anmeldeschluss ist der <strong>" . ABSOLVENTENFEIER_ANMELDESCHLUSS . "</strong>.<br>\n";
					echo "Bitte haben Sie Verständnis, dass spätere Anmeldungen unter Umständen nicht mehr berücksichtigt werden können.<br>\n";
					echo "Falls Sie als Gast lediglich am offiziellen Festakt teilnehmen möchten ist keine Anmeldung erforderlich.<br>\n";
					echo "<br>\n";
					echo "Alle weiteren Informationen zur Anmeldung finden sie hier: <a href=\"../anmeldung_absolventenfeier/index.php\">Anmeldung zur Absolventenfeier</a>.\n";
					echo "</p>\n";
				}
				?>
				

				<h3>Eintrittspreis</h3>
				<p>
				Der offizielle Teil ist für alle Gäste kostenlos.<br>
				<br >
				<?php
				if(ABSOLVENTENFEIER_INFO_AKTIV) {
					echo "Der Eintritt für die Teilnahme an den anschließenden Feierlichkeiten beträgt " . ABSOLVENTENFEIER_PREIS . " Euro pro Person.\n";
				}
				else {
					echo "Die Teilnahme an den anschließenden Feierlichkeiten beträgt voraussichtlich ca. 25 Euro pro Person.\n";
				}
				?>
				Dieser Unkostenbeitrag beinhaltet nicht nur die Kosten der Zeremonie, sondern auch den Preis des anschließenden Buffets sowie Band/Musik und Dekoration etc. 
				</p>

			
				
				<br>
				<br>
				<h2>Der offizielle Teil</h2>
				
				<div class="right_img_container">
					<img src="../_images_content/urkundenuebergabe.jpg" alt="Urkundenübergabe" style="width:450px;">
				</div>

				<h3>Teilnahme am offiziellen Teil</h3>
				<p>
				Eine Anmeldung für den offiziellen Teil ist nur dann erforderlich, wenn man als aktueller Absolvent an der Zeremonie mit Urkundenverleih teilnehmen möchte.
				Gäste, die nur am offiziellen Festakt teilnehmen möchten, müssen sich nicht anmelden. 
				Jeder ist herzlich eingeladen der Verabschiedung der Absolventen und dem Festvortrag beizuwohnen.
				</p>
				
				

				<h3>Vorraussetzungen für den Urkundenverleih</h3>
				<p>
				Jeder, der zum Zeitpunkt der Feier bereits sein Zeugnis erhalten hat, kann sich auch für die Zeremonie mit Urkundenverleih anmelden. 
				Die einzige Vorraussetzung ist, dass man im Absolventen- und Förderverein Mitglied ist. Keine Sorge, diejenigen, die das nicht bleiben möchten, 
				können sich im Anschluss an die Absolventenfeier ohne Kündigungsfrist wieder austragen. Auch vom Mitgliedsbeitrag ist man im ersten Jahr freigestellt.<br>
				<?php
				if(ABSOLVENTENFEIER_ANMELDUNG_AKTIV) {
					echo "<a href=\"../anmeldung_absolventenfeier/index.php\">Details zur Anmeldung</a>\n";
				}
				?>
				</p>

				
				<br>
				<br>
				<h2>Der gemütliche Teil - Das Buffet</h2>

				
				<div class="left_img_container">
					<img src="../_images_content/buffet2.jpg" alt="Büffet" style="width:400px;">
				</div>
				
				<h3>Teilnahme an den anschließenden Feierlichkeiten</h3>
				<p>
				Um nach dem Festakt an den Feierlichkeiten mit Buffet teilzunehmen, ist eine vorherige Anmeldung erforderlich.<br>
				Dieser Teil der Absolventenfeier beginnt nach dem offiziellen Festakt und ist Open-End.<br>
				<?php
				if(ABSOLVENTENFEIER_ANMELDUNG_AKTIV) {
					echo "Die Anmeldung kann online erfolgen, mehr Informationen dazu finden sie auf folgender Seite: <a href=\"../anmeldung_absolventenfeier/index.php\">Details zur Anmeldung</a>\n";
				}
				else {
					echo "Die Anmeldung kann online erfolgen, sie wird rechtzeitig vor der Feier freigeschaltet.\n";
				}
				?>
				</p>

				<br style="clear:both">
				
				
				<br>
				<br>
				<h2>Wichtig: Organisationsteam</h2>
				<p>
				Die Absolventenfeiern werden traditionell vom Absolventenverein gemeinsam mit einigen aktuellen Absolventen organisiert. 
				Der Verein "aluMPI" steuerte dazu die Internetplattform und den groben Ablauf der Feier, sowie wichtige Erfahrungen beim Organisieren der letzten Feiern bei. 
				Der Verein verfügt außerdem über die finanziellen Mittel, die Unkosten der Feier auszulegen.<br>
				Für die Details sollten allerdings die Absolventen zuständig sein, um die Feierlichkeiten genau nach den Wünschen der aktuellen Absolventen zu gestalten.
				Der Vorstand des Absolventenvereins ist darüber hinaus nicht mehr unbedingt in Bayreuth vor Ort. 
				Ohne ein Organisationsteam von aus einigen aktuellen Absolventen ist es uns also nicht möglich, eine Absolventenfeier auf die Beine zu stellen.
				</p>
				<p>
				Zu organisieren gilt es die Tischdeko, den Festredner, das Buffet, die Band, ggf. ein Abschiedsgeschenk, die Einladungen und beispielsweise auch Helfer aus den Reihen der Studenten, 
				damit ihr an der Feier nicht selbst auf- und abbauen, oder Getränke ausschenken müsst. 
				Fast alles ist per Telefon machbar. 
				Hast du also genauere Vorstellungen was beispielsweise das Essen betrifft, oder möchtest du mithelfen, dass die Feier in einem erträglichen finanziellen Rahmen bleibt? 
				Oder bist du noch Student und möchtest mithelfen, so dass deine Mitstudenten eine schöne Feier erleben? 
				Dann hilf mit und melde dich bei uns unter alumpi@uni-bayreuth.de
				</p>
				<br>
			
			</section>
			
			
        </section>
		