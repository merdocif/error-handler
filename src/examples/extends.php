<?php

use ErrorHandler\DefaultErrorsMethods;

class ExamplesClass extends DefaultErrorsMethods{

    public static function exampleException($variable){
        if(!is_array($variable)){
            throw new \Exception('is not array');
        }
        return true;
    }
}

$exampleString = 'example';
$exampleArray = array('example');

var_dump(ExamplesClass::getError('exampleException',array($exampleString)));
