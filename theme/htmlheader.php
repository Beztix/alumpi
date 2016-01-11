<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	
	<?php /* Einfügen der in der index.php definierten Variablen, ansonsten Standard-Titel, Keywords und Description  */ ?>
    <title><?php if(isset($title)) { echo $title; } else { echo "AluMPI e.V."; } ?></title>
	<meta name="keywords" content="<?php if(isset($keywords)) { echo $keywords; } else { echo "This is the, default set of, keywords"; } ?>" />
    <meta name="description" content="<?php if(isset($description)) { echo $description; } else { echo "This is the default page description."; } ?>" />
    
	<link href="../css/new.css" rel="stylesheet"/>


<?php 
//optionales Einbinden von zusätzlichem (seitenspezifischem) header-code	
if(file_exists('headers.php')) { 
	echo '\t'; 
	include 'headers.php'; 
	echo '\n'; 
}; 
?>

<?php 
//optionales Einbinden von zusätzlichen (seitenspezifischen) scripts 
if(file_exists('scripts.php')) {
    echo "\t" . '<script>' . "\n\t" . '/* <![CDATA[ */';
    include 'scripts.php';
    echo "\t" . '/* ]]> */' . "\n\t" . '</script>' . "\n"; 
};
?>
</head>


