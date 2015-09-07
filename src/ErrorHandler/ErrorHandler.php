<?php
/**
 * Created by PhpStorm.
 * User: merdoc_if
 * Date: 14.08.15
 * Time: 15:44
 */

namespace ErrorHandler;

class errorHandler {

    protected static $className = __CLASS__;

    /**
     * @param string $method
     * @param array $userParameters
     * @param null $debug
     */
    public static function getError($method,$userParameters,$debug=null){
        $childClass = NULL;
        /** if extends  class, search and check child class name */
        if (!method_exists(self::$className, $method)) {

            $childClass = get_called_class();

            /** initialize  ReflectionMethod */
            $reflectionMethod = new ReflectionMethod($childClass, $method);

            /** all parameters selected method */
            $methodParameters = $reflectionMethod->getParameters();

            /** compare users and own method parameters */
            $compare = self::compareCountParametersOfMethods($methodParameters, $userParameters);

        } else {
            /** check method name and userParameters*/
            self::validateMethod($method);
            self::validateUserParameters($userParameters);

            /** initialize  ReflectionMethod */
            $reflectionMethod = new ReflectionMethod(self::$className, $method);

            /** all parameters selected method */
            $methodParameters = $reflectionMethod->getParameters();

            /** compare users and own method parameters */
            $compare = self::compareCountParametersOfMethods($methodParameters, $userParameters);
        }

        if($compare){
            try{
                if(!method_exists(self::$className,$method)){
                    call_user_func_array(array($childClass,$method),$userParameters);
                }else{
                    call_user_func_array(array(self::$className,$method),$userParameters);
                }

            } catch (\Exception $e){
                if($debug === true){
                    echo 'Error: { File:',$e->getFile(),'{ Line:',$e->getLine(), ' { Message: ', $e->getMessage(),'} } }', "\n";
                }else {
                    echo 'Error: { Message: ', $e->getMessage(), ' }', "\n";
                }
                die();
            }
        }
    }

    /**
     * @param $variable
     * @return mixed
     * @throws Exception
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
     * @throws Exception
     */
    protected static function isArrayDefault($variable){
        if(!is_array($variable)){
            throw new \Exception('Variable is not ARRAY');
        }
        return true;
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
        self::isArrayDefault($methodParameters);
        self::isArrayDefault($userParameters);

        /** */
        if(count($methodParameters) === count($userParameters) ){
            return count($methodParameters);
        }else{
            echo self::toString( "Error:Amount method parameters do not match with an actual");
            die();
        }

    }

    /**
     * @param string $action_name
     * @return mixed
     * @throws Exception
     */
    public static function actionExist($action_name){

        self::isStringDefault($action_name);

        if(empty($action_name)){
            throw new \Exception('Variable action_name is empty');
        }
        return true;
    }

    /**
     * @param $action_name
     * @param $route_spec
     * @return mixed
     * @throws Exception
     */
    public static function arrayKeyExist($action_name , $route_spec) {

        if(!array_key_exists($route_spec,$action_name)){
            throw new \Exception('Undefined index');
        }
        return $route_spec;
    }

    /**
     * @param $file_name
     * @return mixed
     */
    public static function fileExist($file_name) {
        if(file_exists($file_name)){
            return $file_name;
        }else{
            $array = array('data'=>array('message'=>'There is no specified file, as the name describe the inspection type does not exist '));
            self::toString($array);
            die();
        }
    }


    /**
     * @param $dir
     * @return bool
     * @throws Exception
     */
    public static function dirExist($dir){
        if(!is_dir($dir)){
            throw new \Exception('Directory does not exist');
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