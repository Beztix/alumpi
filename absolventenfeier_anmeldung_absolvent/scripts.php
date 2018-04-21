<?php

//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}

?>

<script type="text/javascript">
function toggleMitgliedsantragDisplay() {
  // Get the checkbox
  var checkBox = document.getElementById("mitgliedsantragCheckbox");
  
  // Get the output text
  var text = document.getElementById("mitgliedsantragDisplay");

  // If the checkbox is checked, display the output text
  if (checkBox.checked == true){
    text.style.display = "block";
  } else {
    text.style.display = "none";
  }
} 
</script>