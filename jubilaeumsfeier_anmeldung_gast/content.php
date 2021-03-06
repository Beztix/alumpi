<?php
//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}
?>

<section id="content">
    <section class="top_image">
        <img src="../_images_content/banner_sektglaeser.jpg" alt="Sektgläser">
    </section>

    <section class="text">
	<h1>Buchung von Festaktkarten</h1>
        <p>Hier können Sie eine oder mehrere Festaktkarten buchen.</p>
        <p>
            Die Festaktkarten berechtigen Sie zur Teilnahme an der kompletten Veranstaltung, d.h. am Sektempfang, dem Festakt, dem Buffet und den anschließenden Feierlichkeiten. 
            Einlass ist um 16:00 Uhr. 
        </p>
        <p>
            Der Preis einer Festaktkarte beträgt <?= ABSOLVENTENFEIER_PREIS ?> € und ist per Überweisung zu bezahlen. Sie erhalten Ihre Gästelistenplätze nach Eingang der Zahlung.
            Wenn Sie als Absolvent an der Absolventenehrung teilnehmen möchten, wählen Sie bitte die Option 
            „<a href="../jubilaeumsfeier_anmeldung_absolvent/index.php">Buchung von Festaktkarten (als aktueller Absolvent)</a>“.
        </p>

        <?php 
        if(JUBILAEUMSFEIER_ANMELDUNG_AKTIV) {
            if(JUBILAEUMSFEIER_FESTAKT_KARTEN_AKTIV) {
                include './content_partyNonGraduateRegistrationForm.php';

                echo "<div id=\"result\"></div>\n";
                include '../_includes_functionality/process_partyGraduateRegistrationForm.php';
            } else {
                echo "<p>\n";
                echo "Leider sind alle Festaktkarten ausverkauft.\n";
                echo "</p>\n";    
            }
        } else {
            echo "<p>\n";
            echo "Aktuell ist keine Anmeldung zum Jubiläumsball mehr möglich.\n";
            echo "</p>\n";
        }
        ?>
    </section>
</section>