<?php 
// Get a function library

  include "module/element/security.php";

// security_level now support only "1"
// Basic using $security->removexss(input, security_level)
// this function help to remove basic html xss on php

  echo $security->removexss($AnythingToCleanedMessageInXss, "1");
?>

