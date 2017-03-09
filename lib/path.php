<?php
class Path {
  private $page = "index";
  public function __construct() {
    if((isset($_GET["path"])) && ($_GET["path"] != ""))
    {
      $this->page = $_GET["path"];

      if(substr($this->page,-1,1) == "/")
        $this->page = substr($this->page,0,-1);
    }
  }

  public function get() {
    return $this->page;
  }
}
?>
