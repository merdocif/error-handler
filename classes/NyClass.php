<?php
/**
 * Created by PhpStorm.
 * User: m1
 * Date: 04.09.15
 * Time: 16:27
 */
require_once 'ErrorHandler.php';


class MyClass extends errorHandler{
    protected static function omg($data){
        if(!is_string($data)){
            throw new \Exception('Variable is not STRING');
        }
        return true;
    }
}