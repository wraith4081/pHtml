<?php 
// Get a function library

  include "module/element/server.php";


// Basic using $server->maxmemory(size) , you only can write <size>M or <size>G. 
//If you use this function can you limit a maximum memory usage

  $server->maxmemory("1024M");
// This make same think
  $server->maxmemory("1G");
?>
