<?php

//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}

?>

<script type="text/javascript">
function toggleMitgliedsantragDisplay() {
  var checkBox = document.getElementById("mitgliedsantragCheckbox");
  
    if (checkBox.checked == true){
    document.getElementById("mitgliedsantragDisplay").style.display = "block";
	document.getElementById("datenspeicherungDisplay").style.display = "none";
  } else {
    document.getElementById("mitgliedsantragDisplay").style.display = "none";
	document.getElementById("datenspeicherungDisplay").style.display = "block";
  }
} 

function showForm($name) {
  document.getElementById("graduateForm").style.display = "none";
  document.getElementById("nonGraduateForm").style.display = "none";
  document.getElementById("laufkarteForm").style.display = "none";
  document.getElementById($name).style.display = "block";
}
</script>