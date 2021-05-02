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

### Security

#### $security->removexss
```php
include "module/element/security.php";
  /* security_level now support only "1" */
  /* $security->removexss(input, security_level) */
echo $security->removexss($AnythingToCleanedMessageInXss, "1");
```
* When we use this functions, this function help to remove basic html xss on php. 
* State of development : %100(Development Complated, Pre-release)
* Example code in the examples/removexss.php


#### $security->ddosprotection
```php
include "module/element/security.php";
  // status if become to 1 ddos protection to enabled on used page
  // Basic using $security->ddosprotection(status)
  // this function help to block to basic level ddos
echo $security->ddosprotection("1");
```
* When we use this functions, this function help to block to basic level ddos.
* State of development : %100(Development Complated, Pre-release)
* Example code in the examples/ddosprotection.php
### Server

#### $server->maxmemory
```php
include "module/element/server.php";
  /* limit only support <size>M or <size>G */
  /* $server->maxmemory(limit) */
  $server->maxmemory("1024M");
// This Make same thing
  $server->maxmemory("1G");

```
* When we use this functions, this function help to limit to memory usage.
* State of development : %100(Development Complated, Pre-release)
* Example code in the examples/memorylimit.php
