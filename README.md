# Error-handler
Simple error handler with the output in json format

# Install package 
    

```json

"mifsoft/error-handler":"dev-dev-alpha-0.0.1"

```

# Simple example of default methods


```php
<?php

use ErrorHandler\DefaultErrorsMethods;

$string = '';
$array = array(0=>'one',1=>'two');

var_dump(DefaultErrorsMethods::getError('isStringDefault',array($array)));
```
# Simple example of customers methods

```php
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

```