<?php

namespace ErrorHandler;

class ErrorCore {

    protected static $className = __CLASS__;

    /**
     * @param string $method
     * @param array $userParameters
     * @param null $debug
     */
    public static function getError($method,$userParameters,$textFormat=null,$debug=null){
        $className = NULL;
        /** if extends  class, search and check child class name */
        if (!method_exists(self::$className, $method)) {
            $className = get_called_class();
        } else {
            $className = self::$className;
        }

        /** check method name and userParameters*/
        self::validateMethod($method);
        self::validateUserParameters($userParameters);

        /** initialize  ReflectionMethod */
        $reflectionMethod = new \ReflectionMethod($className, $method);

        /** all parameters selected method */
        $methodParameters = $reflectionMethod->getParameters();

        /** compare users and own method parameters */
        $compare = self::compareCountParametersOfMethods($methodParameters, $userParameters);

        if($compare){
            try{
                call_user_func_array(array($className,$method),$userParameters);
            } catch (\Exception $e){

                if($textFormat === true){
                    if($debug === true){
                        echo 'Error: { File:',$e->getFile(),'{ Line:',$e->getLine(), ' { Message: ', $e->getMessage(),'} } }', "\n";
                    }else {
                        echo 'Error: { Message: ', $e->getMessage(), ' }', "\n";
                    }
                }else{
                    if($debug === true){
                        json_encode('Error: { File:',$e->getFile(),'{ Line:',$e->getLine(), ' { Message: ', $e->getMessage(),'} } }');
                    }else {
                        json_encode('Error: { Message: ', $e->getMessage(), ' }');
                    }
                }


                die();
            }
        }
    }

    /**
     * @param $parameter
     * @return bool
     */
    protected static function validateMethod($parameter) {
      if(empty($parameter)){
          echo self::toString('Method Name can not be empty');
          die();
      }else if(!is_string($parameter)){
          echo self::toString('The variable must be a string');
          die();
      }
        return true ;
    }

    /**
     * @param $parameter
     * @return bool
     */
    protected static function validateUserParameters($parameter) {
        if(empty($parameter)){
            echo self::toString('Method Name can not be empty');
            die();
        }else if(!is_array($parameter)){
            echo self::toString('The variable must be an array');
            die();
        }
        return true ;
    }

    /**
     * @param array $methodParameters
     * @param array $userParameters
     * @return int
     */
    protected static function compareCountParametersOfMethods($methodParameters, $userParameters) {

        /** check if variables $methodParameters and $userParameters an array  */
        self::isArrayValidate($methodParameters);
        self::isArrayValidate($userParameters);

        if(count($methodParameters) === count($userParameters) ){
            return count($methodParameters);
        }else{
            echo self::toString( "Error:Amount method parameters do not match with an actual");
            die();
        }
    }

    /**
     * @param $variable
     * @return bool
     */
    protected static function isArrayValidate($variable){
        if(!is_array($variable)){
            echo self::toString('Variable is not ARRAY');
            die();
        }
        return true;
    }

    /**
     * @param $message
     * @return array|string
     */
    protected static function toString($message) {
        $array = array('data'=>array('message'=>$message));
        $array = json_encode($array);
        return $array;
    }

}