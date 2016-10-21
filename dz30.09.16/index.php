<?php

//Пишемо загрузчик

$classesDir = array (
    'cont/',
    'modul/',
    'html/',
		'lib/'
    );
function __autoload($class_name) {
    global $classesDir;
		foreach ($classesDir as $directory) {
        $class_file = $directory . $class_name . ".php";
        $class_file = strtolower($class_file);
				if (file_exists($class_file)) {
					 	
						require_once $class_file;
            break;
        }
        else {
						 continue;
				}
				if (!file_exists($class_file)){
            throw new Exception("No class!");
        }
    }
}

$obrobka = new Obrobnyk($_SERVER['REQUEST_URI']);
$obrobka->analyse_adr();
$obrobka->data_file();
$obrobka->dani();
if (isset($_GET["nov_rah"]) and $_GET["nov_rah"] == "1") {
	 				 $obrobka->vnesty_rah();
	 				 unset($_GET);
					 header("Location: Obrobnyk::$uri");
					 exit;
	 				 }
$obrobka->html_file();
$obrobka->vyvid();

?>