<?php
class tag {
  // Properties
  public $tag;
  public $text;

  // functions
  function createvalue($tag, $text) {
    var returnvalue = "<" . $tag . ">" . $text . "</" . $tag . ">";
    return returnvalue;
  }
}

$header = new tag();

echo $header->createvalue("p","Hi everyone!";
?>
