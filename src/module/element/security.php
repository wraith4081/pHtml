<?php
class security {
  // Properties
  public $input;
  public $security_level;

  // functions
  function removexss($input, $security_level) {
    if ($security_level > 0) {
      var returnvalue = filter_var($input, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
      return $returnvalue;
    }
  }
   
}
$security = new security();
?>
