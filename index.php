<?php
/**
 * Created by PhpStorm.
 * User: merdoc_if
 * Date: 14.08.15
 * Time: 15:43
 */
define('APP_ROOT', __DIR__);

ini_set("display_errors", 1);
ini_set("track_errors", 1);
ini_set("html_errors", 1);
error_reporting(E_ALL);

//require_once 'classes/ErrorHandler.php';


require_once 'classes/NyClass.php';
require_once 'classes/MyNewClass.php';
require_once 'classes/HttpAuth.php';


$directory = __DIR__.'/config/';

$file = $directory.'config.php';

$test = new HttpAuth();


//var_dump($test);


/*
if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header('WWW-Authenticate: Basic realm="Authenticate"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Access deny';
    exit;
} else {

    echo "<a href='logout.php'>Logout</a>";


    $ldap = ldap_connect("localirish.api");
    $bind = ldap_bind($ldap, $_SERVER['PHP_AUTH_USER'].'@irishwater.api', $_SERVER['PHP_AUTH_PW']);

    if ($bind) {
        echo "true";
    } else {
        echo "FALSE";
    }
}
*/







$omg = 1;
$rr = 'dirExist';
$twt = array('dhgd');


$rr1 = 'omg1';


$t = new MyClass();
$t1 = new MyNewClass();




//var_dump(MyClass::getError($rr,array($omg)));
//var_dump($t->getError($rr,array($omg)));
//var_dump($t1->getError($rr1,array($omg)));
//var_dump(errorHandler::getError($rr,array($omg)));
//errorHandler::getError($rr,array($omg));


//echo(false ? 'false':'true');

//$test->showErrorMessage('actionExist',$a);

//$r = new ReflectionMethod($test,'arrayKeyExist');
//$params = $r->getParameters();
//foreach ($params as $param) {
//    //$param is an instance of ReflectionParameter
//    echo $param->getName();
//    echo $param->isOptional();
//}


