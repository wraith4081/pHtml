<?php 
// Get a function library

  include "module/element/security.php";

// status if become to 1 ddos protection to enabled on used page
// Basic using $security->ddosprotection(status)
// this function help to block to basic level ddos

  echo $security->ddosprotection("1");
?>
