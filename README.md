# Error-handler
Simple error handler with the output in json format

# Example 
```php
<?php

use ErrorHandler\DefaultErrorsMethods;

$string = '';
$array = array(0=>'one',1=>'two');

var_dump(DefaultErrorsMethods::getError('isStringDefault',array($array)));

```
