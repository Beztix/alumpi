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

function showMailWarning() {
  var mail = document.getElementById("email").value;
  if(mail) {
    var matches = mail.match(/^[^@]*@(?:uni-bayreuth\.de).*$/);
    if(matches) {
      var isUniversityMail = matches.length >= 0;
      if(isUniversityMail) {
        document.getElementById("email-validation-warning").style = "display:block;";
        return;
      }
    }
  }
  document.getElementById("email-validation-warning").style = "display:none;";
}
</script>