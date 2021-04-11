<?php
class server {
  // Properties
  public $server;
  public $limit;

  // functions
  function maxmemory($limit) {
    if (str_contains($limit, "M") {
          ini_set('memory_limit', $limit . "M");
    } else if (str_contains($limit, "G") {
           ini_set('memory_limit', str_replace("G","",$limit) * 1024 . "M");
    } else {
      echo "Hata: Lütfen bellek limiti belirlerken <miktar>M veya <miktar>G olarak yazın!"
    }
  }
}
$server = new server();
?>
