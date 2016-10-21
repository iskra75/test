<?php
//IndexController
//UserModel
function __autoload($class_name)
{
    if(stristr($class_name, 'controller')){
        $path = "../app/controllers/";
    } else if(stristr($class_name, 'model')){
        $path = "../app/models/";
    } else {
        $path = "../lib/";
    }

    $filePath = "{$path}{$class_name}.php";

    if(file_exists($filePath)){
        require_once $filePath;
    } else {
        throw new Exception("No class!");
    }
}

$app = new Loader($_SERVER['REQUEST_URI']);
$app->run();


//define('DS', DIRECTORY_SEPARATOR);
//define('ROOT', dirname(dirname(__FILE__)));
//define('VIEWS_PATH', ROOT.DS.'views');
//
//require_once(ROOT.DS.'lib'.DS.'init.php');
//
//session_start();
//
//App::run($_SERVER['REQUEST_URI']);