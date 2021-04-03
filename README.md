# pHtml
thanks to this library, which is currently in development, you can only do backend and frontend functions with PHP without using HTML, with simple and changeable functions.

## Simple Functions

### Tag

#### $tag->createvalue
```php
/* $tag->createvalue(tagName, text, output);*/
$tag->createvalue("h1", "This a test function", "echo");
// or 
echo $tag->createvalue("h1", "This a test function", "return");
```
* When we use this functions, it will generate and write h1 tag and that says "This a test function". 
* State of development : %100(Development Complated, Pre-release)
* Example code in the examples/create.php


#### $tag->count
```php
/* $tag->count();*/
echo $tag->count();
```
* When we use this functions, it counts a all created pHtml tags. 
* State of development : %100(Development Complated, Pre-release)
* Example code in the examples/counttag.php

#### $security->removexss
```php
<?php 
  include "module/element/security.php";
/* security_level now support only "1" */
/* $security->removexss(input, security_level) */
  echo $security->removexss($AnythingToCleanedMessageInXss, "1");
?>```
* When we use this functions, this function help to remove basic html xss on php. 
* State of development : %100(Development Complated, Pre-release)
* Example code in the examples/removexss.php

