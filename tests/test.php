<?php
/**
 * Created by PhpStorm.
 * User: m1
 * Date: 07.09.15
 * Time: 11:40
 */


ini_set("display_errors", 1);
ini_set("track_errors", 1);
ini_set("html_errors", 1);
error_reporting(E_ALL);
require_once __DIR__ . '/vendor/autoload.php'; // Autoload files using Composer autoload

use ErrorHandler\errorHandler;
$test = 'shdgd';

errorHandler::getError('sss',array('sjdgd'));

