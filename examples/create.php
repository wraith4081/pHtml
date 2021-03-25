<?php 
// Get a function library

  include "module/element/tag.php";


// Basic using $tag->createvalue(ELEMENT,MESSAGE,TYPE) , TYPE ONLY SUPPORTS "return" or "echo". 
// If TYPE value is echo this automaticly write this but TYPE value become a "return" this become using only returns html basic element.

  echo $tag->createvalue("h1","Hi everyone!","return");
  $tag->createvalue("p","this a test function!","echo");


// This out Same output but TYPE value is "echo" this more optimationed usage for html write to document.

  echo $tag->createvalue("p","Output test","return");
  $tag->createvalue("p","Output test","echo");


?>
