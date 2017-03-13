<?php
  require_once("response.class.php");
  class BasicController{
    public function run($action,$data){
      return Response::error("Invalid Action.");
    }
  }
?>
