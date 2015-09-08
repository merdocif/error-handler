<?php
/**
 * Created by PhpStorm.
 * User: m1
 * Date: 08.09.15
 * Time: 13:10
 */
namespace ErrorHandler;

class DefaultErrorsMethods extends ErrorCore {

    /**
     * @param $variable
     * @return bool
     * @throws \Exception
     */
    protected static function isStringDefault($variable) {
        if(!is_string($variable)){
            throw new \Exception('Variable is not STRING');
        }
        return true;
    }

    /**
     * @param $variable
     * @return bool
     * @throws \Exception
     */
    protected static function isArrayDefault($variable){
        if(!is_array($variable)){
            throw new \Exception('Variable is not ARRAY');
        }
        return true;
    }

    /**
     * @param $action_name
     * @param $route_spec
     * @return mixed
     * @throws \Exception
     */
    public static function arrayKeyExistDefault($action_name , $route_spec) {

        if(!array_key_exists($route_spec,$action_name)){
            throw new \Exception('Undefined index');
        }
        return true;
    }

}