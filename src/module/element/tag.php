<?php
class tag {
  // Properties
  public $tag;
  public $text;

  // functions
  function createvalue($tag, $text, $type) {
    var returnvalue = "<" . $tag . ">" . $text . "</" . $tag . ">";
    $type $returnvalue;
  }
}

$tag = new tag();
?>
