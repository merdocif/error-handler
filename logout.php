<?php
/**
 * Created by PhpStorm.
 * User: m1
 * Date: 03.09.15
 * Time: 10:39
 */

unset($_SERVER['PHP_AUTH_USER']);
unset($_SERVER['PHP_AUTH_PW']);

header('HTTP/1.0 401 Unauthorized');


