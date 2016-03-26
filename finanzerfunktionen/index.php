<!DOCTYPE html>
<html>

<?php
// Konstante, die in inkludierten PHP-Dateien abgefragt wird, um direkten Zugriff auf die inkludierten Datein zu verhindern
define('AccessConstant', TRUE);

session_start();
require '../_includes_functionality/global_constants.php';


$thisPage = 'finanzerfunktionen';
$title = 'AluMPI | Finanzerfunktionen';
$keywords = '';
$description = '';


//Definition der Seitenspezifischen Zugriffsrechte
//True = Gruppe darf diese Seite sehen
//False = Gruppe darf diese Seite NICHT sehen
$foerderer_zugriff = False;
$mitglied_zugriff = False;
$orga_zugriff = False;
$kuratorium_zugriff = False;
$finanzer_zugriff = True;
$vorstand_zugriff = True;
$admin_zugriff = True;



//Einbinden von auth.php, um diese Seite nur eingeloggten Mitgliedern mit passenden Zugriffsrechten zur Verfügung zu stellen
require '../_includes_functionality/auth.php'; echo "\n"; 	
?>


<?php require '../_includes_layout/htmlheader.php'; echo "\n"; ?>



<body>
    
	
<?php require '../_includes_layout/header.php'; echo "\n"; ?>


	<section id="main">
		
		
<?php require'../_includes_layout/navigation.php'; echo "\n"; ?>
<?php include 'content.php'; echo "\n"; ?>


	</section>

		
<?php require '../_includes_layout/footer.php'; echo "\n"; ?>


   
</body>
</html>