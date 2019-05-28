<?php
//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}
?>

<section id="content">
    <section class="top_image">
        <img src="../_images_content/savethedate_jubilaeumsball.jpg" alt="Sektgläser">
    </section>

    <section class="text">
        <p>Hier können Sie eine oder mehrere Festaktkarten buchen.</p>
        <p>
            Die Festaktkarten berechtigen Sie zur Teilnahme an der kompletten Veranstaltung, d.h. am Sektempfang, dem Festakt, dem Buffet und den anschließenden Feierlichkeiten. 
            Einlass ist um 16:00 Uhr. 
        </p>
        <p>
            Der Preis einer Festaktkarte beträgt <?= ABSOLVENTENFEIER_PREIS ?>€ und ist per Überweisung zu bezahlen. Sie erhalten Ihre Gästelistenplätze nach Eingang der Zahlung.
            Wenn Sie als Absolvent an der Absolventenehrung teilnehmen möchten, wählen Sie bitte die Option 
            „<a href="../jubilaeumsfeier_anmeldung_absolvent/index.php">Buchung von Festaktkarten (als aktueller Absolvent)</a>“
        </p>

        <?php 
        include_once '../_includes_functionality/calculateAccessPermissions.php';
        $zugriff_erlauben = doesCurrentUserHaveAccess($foerderer_zugriff, $mitglied_zugriff, $orga_zugriff, $kuratorium_zugriff, $finanzer_zugriff, $vorstand_zugriff, $admin_zugriff);
        if($zugriff_erlauben) {
            include './content_partyNonGraduateRegistrationForm.php';

            echo "<div id=\"result\"></div>\n";
            include '../_includes_functionality/process_partyGraduateRegistrationForm.php';
        } else {
            echo "Diese Seite wird ständig aktualisiert, schauen Sie also bald wieder vorbei!";
        }
        ?>
    </section>
</section>