<?php

//======================================================================
// Diese PHP-Datei enthält den HTML-Header der Webseite, der sich auf jeder Seite der Homepage befindet und die 
// Meta-Informationen zur Webseite enthält. 
// Sie wird von der jeweiligen index.php eingebunden. Die Seitenspezifischen Meta-Informationen (Title, Keywords etc.) 
// müssen hierbei in der index.php als PHP-Variable deklariert werden, andernfalls werden Default-Werde verwendet.
//======================================================================

//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}



?>		


<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="shortcut icon" href="../_images_layout/favicon.ico">

<?php 
// Einfügen der in der index.php definierten Variablen, ansonsten Standard-Titel, Keywords und Description

if(!isset($title)) { 
	$title = "AluMPI e.V.";
}
echo "\t<title>" . $title . "</title>\n";



$standardKeywords = "AluMPI, Absolventenverein, Förderverein, Absolvent, Alumni, Student, Universität, Bayreuth, Fakultät, Physik, Mathematik, Informatik, MPI" ;
$keywords = $standardKeywords . ", " . $keywords;

echo "\t<meta name=\"keywords\" content=\"" . $keywords . "\" />\n";


if(!isset($description)) { 
	$description = "Die Homepage des Absolventen- und Fördervereins MPI Universität Bayreuth e.V., kurz AluMPI";
}
echo "\t<meta name=\"description\" content=\"" . $description . "\" />\n";
?>
  
	<link href="../_css/new.css" rel="stylesheet"/>
	<link href="../_css/lightbox.css" rel="stylesheet"/>

<?php 
//optionales Einbinden von zusätzlichem (seitenspezifischem) header-code	
if(file_exists('headers.php')) { 
	echo "\t"; 
	include 'headers.php'; 
	echo "\n"; 
}; 
?>

<?php 
//optionales Einbinden von zusätzlichen (seitenspezifischen) scripts 
if(file_exists('scripts.php')) {
    echo "\t";
    include 'scripts.php';
    echo "\n"; 
};
?>
</head>


