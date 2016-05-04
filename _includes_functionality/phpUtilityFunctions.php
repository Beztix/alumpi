<?php

//======================================================================
//
//======================================================================

//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}



//Hilfsfunktion, um Werte als Reference statt als Value zu übergeben
//(benötigt für mysqli bind_params in Kombination mit call_user_func_array(), da hier die Werte als Reference übergeben werden müssen)
function refValues($arr){
    if (strnatcmp(phpversion(),'5.3') >= 0) //Reference is required for PHP 5.3+
    {
        $refs = array();
        foreach($arr as $key => $value)
            $refs[$key] = &$arr[$key];
        return $refs;
    }
    return $arr;
}
	
	
?>