<?php
/**
 * Created by PhpStorm.
 * User: m1
 * Date: 03.09.15
 * Time: 11:15
 */
require_once 'ErrorHandler.php';


class HttpAuth {

    function __construct(){

        errorHandler::getError('dirExist', array(APP_ROOT));

        $files = scandir(APP_ROOT);

        $string = APP_ROOT.'/config/';

        $opendir = opendir($string);

        while (($file = readdir($opendir)) !== false) {
            $pathinfo = pathinfo($file);

            $f1 = $string.$file;

            if(is_file($f1)){
                echo $pathinfo['extension'].' ';
            }

        }

        foreach($files as $filesKey=>$filesValue){
//            if($filesValue === $file){
//
//            }
        }
    }



    public function login() {

    }

    public function logout() {
        unset($_SERVER['PHP_AUTH_USER']);
        unset($_SERVER['PHP_AUTH_PW']);
        header('HTTP/1.0 401 Unauthorized');
    }
}