<?php
/** */

namespace ErrorHandler;

class ErrorCore {

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
            $reflectionMethod = new \ReflectionMethod($childClass, $method);

            /** all parameters selected method */
            $methodParameters = $reflectionMethod->getParameters();

            /** compare users and own method parameters */
            $compare = self::compareCountParametersOfMethods($methodParameters, $userParameters);

        } else {
            /** check method name and userParameters*/
            self::validateMethod($method);
            self::validateUserParameters($userParameters);

            /** initialize  ReflectionMethod */
            $reflectionMethod = new \ReflectionMethod(self::$className, $method);

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
     * @param $action_name
     * @return bool
     * @throws \Exception
     */
    public static function actionExist($action_name){

        self::isStringDefault($action_name);

        if(empty($action_name)){
            throw new \Exception('Variable action_name is empty');
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