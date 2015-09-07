<?php
/**
 * Created by PhpStorm.
 * User: m1
 * Date: 04.09.15
 * Time: 16:27
 */
require_once 'ErrorHandler.php';


class MyNewClass extends errorHandler{
    protected static function omg1($data){
        if(!is_string($data)){
            throw new \Exception('Variable is not STRING');
        }
        return true;
    }
}