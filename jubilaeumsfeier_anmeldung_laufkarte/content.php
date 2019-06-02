<?php
//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}
?>

<section id="content">
    <section class="top_image">
		<img src="../_images_content/banner_sektglaeser.jpg" alt="Sektgläser">
	</section>

    <section class="text">
        <h1>Buchung von Laufkarten</h1>
        <p>
            Hier können Sie eine oder mehrere Laufkarten buchen.
        </p>
        <p>
            Die Laufkarten berechtigen Sie zur Teilnahme am Abendprogramm des Jubiläumsballs. 
            Einlass ist um 19:30 Uhr. 
            Der Preis einer Laufkarte beträgt <?= ABSOLVENTENFEIER_PREIS_LAUFKARTE ?> € und ist per Überweisung zu bezahlen. Sie erhalten Ihre Gästelistenplätze nach Eingang der Zahlung.
        </p>
        <p>
            Wenn Sie als Absolvent am Festakt teilnehmen möchten, wählen Sie bitte die Option 
            <a href="../jubilaeumsfeier_anmeldung_absolvent/index.php">„Buchung von Festaktkarten (als aktueller Absolvent)“</a>.
        </p>
        <p>
            Wenn Sie als Gast am Festakt teilnehmen möchten, wählen Sie bitte die Option 
            <a href="../jubilaeumsfeier_anmeldung_gast/index.php">„Buchung von Festaktkarten“</a>.
        </p>
		<br>
        
        <?php 
        include_once '../_includes_functionality/calculateAccessPermissions.php';
        $zugriff_erlauben = doesCurrentUserHaveAccess($foerderer_zugriff, $mitglied_zugriff, $orga_zugriff, $kuratorium_zugriff, $finanzer_zugriff, $vorstand_zugriff, $admin_zugriff);
        if($zugriff_erlauben) {
            include './content_partyLaufkarteRegistrationForm.php';

            echo "<div id=\"result\"></div>\n";
            include '../_includes_functionality/process_partyGraduateRegistrationForm.php';
        } else {
            echo "Diese Seite wird ständig aktualisiert, schauen Sie also bald wieder vorbei!";
        }
        ?>
    </section>
</section>