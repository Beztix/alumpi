<?php
//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}
?>

<section id="content">
    <section class="top_image">
        <img src="../_images_content/banner_sektglaeser.jpg" alt="Sektgläser">
    </section>

    <section class="text">
		<h1>Buchung von Festaktkarten (als aktueller Absolvent)</h1>
        <p>
            Wenn Sie auf der Feier Ihren Abschluss feiern möchten, können Sie hier eine oder mehrere Festaktkarten für sich und Ihre Gäste buchen. 
        </p>
        <p>
            Die Festaktkarten berechtigen Sie zur Teilnahme an der kompletten Veranstaltung, d.h. am Sektempfang, dem Festakt, dem Buffet und den anschließenden Feierlichkeiten. Teil des Festaktes ist die Ehrung der Absolventen des vergangenen Jahres. Teilnehmer der Absolventenehrung erhalten eine Urkunde und ein Absolventengeschenk. 
            Einlass ist um 16:00 Uhr. 
        </p>
        <p>
            Der Preis einer Festaktkarte beträgt <?= ABSOLVENTENFEIER_PREIS ?> € und ist per Überweisung zu bezahlen. Sie erhalten Ihre Gästelistenplätze nach Eingang der Zahlung.
            Sollten Sie kein akuteller Absolvent sein, wählen Sie bitte die Option 
            „<a href="../jubilaeumsfeier_anmeldung_gast/index.php">Buchung von Festaktkarten</a>“.
        </p>


        <h3>Voraussetzungen für den Urkundenverleih</h3>
        <p>
            Jeder, der zum Zeitpunkt der Feier bereits sein Zeugnis erhalten hat, kann sich auch für die Zeremonie mit Urkundenverleih anmelden.
            Auch wenn die erforderlichen Leistungen bereits erbracht wurden und das Prüfungsamt lediglich das Zeugnis noch nicht ausgestellt hat, ist eine Teilnahme in Absprache mit dem Absolventenverein möglich.
        </p>

        
        <?php 
        include './content_partyGraduateRegistrationForm.php'; 

        echo "<div id=\"result\"></div>\n";
        include '../_includes_functionality/process_partyGraduateRegistrationForm.php';
        ?>
    </section>
</section>