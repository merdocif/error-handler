<?php

use ErrorHandler\DefaultErrorsMethods;

/**
 *
 * DefaultErrorsMethods::getError($nameMethod,array($variables))
 */

$string = '';
$array = array(0=>'one',1=>'two');

var_dump(DefaultErrorsMethods::getError('isStringDefault',array($array)));
