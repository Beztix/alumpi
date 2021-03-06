<?php
//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}
?>

<section id="content">

    <section class="top_image">
        <img src="../_images_content/banner_sektglaeser.jpg" alt="Sektgläser">
    </section>


    <section class="text">
	
		<h1>Jubiläumsball 2019</h1>
		
        <a href="#absolventenfeier17plakat">
            <div class="right_img_container">
                <img src="../_images_content/JubilaeumsballKlein.jpg" alt="Plakat Jubiläumsball" style="width:350px;">
            </div>
        </a>

        <a href="#_" class="lightbox" id="absolventenfeier17plakat">
            <img src="../_images_content/JubilaeumsballGross.jpg" alt="Plakat Jubiläumsball">
        </a>
		
		
		<p>				
			Der Jubiläumsball findet am Samstag, den 2. November 2019, im evangelischen Gemeindehaus in Bayreuth statt. Auf über 300m² wird gejubelt, gegessen, gefeiert und getanzt. Eingeladen sind alle Mitglieder des Vereins, alle ehemaligen und aktuellen Angehörigen der Fakultät 1, aber auch alle sonstigen Interessierten und Tanzfreudigen. Ganz klassisch starten wir mit einem  Sektempfang in den Abend. Beim anschließenden Festakt gibt es einen kurzen Rückblick auf die vergangenen 10 Jahre im Verein und der Fakultät.<br>
			Da die Ehrung der Absolventen schon immer ein wesentlicher Bestandteil der Vereinsarbeit war, soll diese auch am Jubiläumsball nicht fehlen. Daher wird jeder anwesende Absolvent geehrt und erhält eine Urkunde sowie ein Präsent des Vereins. Das gemeinsame Gruppenfoto wird die Absolventenwand im NW 2 ergänzen. <br>
			<br>
			Beim anschließenden Buffet kann dann geschlemmt werden, während man sich in ungezwungener Atmosphäre mit den anderen Gästen unterhalten kann. Für die richtigen Getränke sorgt unter anderem die Physikerbar - Studierende unserer Fakultät, die für die Gäste verschiedene klassische Cocktails zaubern.<br>
			<br>
			Nach dem Buffet bringt die Band „Take Three“ aus Frammersbach, die bereits den Festakt begleiten wird, die Feier mit niveauvoller Livemusik 
			richtig in Schwung. Den ganzen Abend lang kann dann getanzt und gefeiert werden. 
        </p>

		<h3>Anmeldung</h3>
		<?php
            if(JUBILAEUMSFEIER_ANMELDUNG_AKTIV) {
                echo "<p>\n";
                echo "Für den Jubiläumsball können Sie sich <a href=\"../jubilaeumsfeier_anmeldeinformationen/index.php\">hier</a> anmelden.";
                echo "</p>";
            } else {
                echo "<p>\n";
                echo "Aktuell ist keine Anmeldung zum Jubiläumsball möglich.\n";
                echo "</p>\n";
            }
            ?>


		
		<div class="left_img_container">
            <img src="../_images_content/deko_absolventenfeier.jpg" alt="Deko Absolventenfeier" style="width:400px;">
        </div>

        <h2>10 Jahre aluMPI</h2>
		
        <p>
			Das Studium vergeht für die meisten wie im Flug. Einschreibung, Umzug, dann Kneipentouren und Erstiveranstaltungen, die erste Klausurenphase… und ehe man sich versieht, ist das Studium vorbei und man steht mit einem Abschlusszeugnis in den Händen vor der sich schließenden Eingangstür des Unigebäudes. Mit einem „Rumms“ fällt sie ins Schloss. Das war's dann wohl, jetzt beginnt der Ernst des Lebens. So oder so ähnlich war es für die Gründer des Vereins vor zehn Jahren. Und ihnen war das nicht genug. Sie wünschten sich, dass dieser Lebensabschnitt mit mehr Würde und einer riesen Party zu Ende geht. Daher entschieden sie sich, eine Feier zu organisieren, an der alle Absolventen diesen Meilenstein ihres Lebens gemeinsam mit Freunden und Verwandten feiern können. <br>
			Die jährliche Absolventenfeier war geboren. <br>
			<br>
			Doch das war den Gründern nicht genug: Sie wollten dafür sorgen, dass sich Absolventen auch nach dem Abschluss an ihre Uni erinnern und einen Bezug erhalten können. Daher entschlossen sie sich, den Absolventen- und Förderverein MPI Uni Bayreuth zu gründen. Dieser hat nicht nur die Organisation der Absolventenfeier zur Aufgabe, sondern soll auch dafür sorgen, eine Vernetzung zwischen Absolventen und Studierenden der Fakultät zu erreichen. Und diese Aufgabe erfüllt der Verein nun schon seit 10 Jahren. 
        </p>
        <h3>Anfahrt und Parkhäuser</h3>
        <iframe src="https://www.google.com/maps/d/embed?mid=1oh0HFEvfHv0ho_Yq3tOC5x1IXW3yBVCe" width="880" height="550"></iframe>


    </section>
</section>
