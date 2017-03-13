<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("../config.php");
$root_path = getRootPath();

require_once("../class/response.class.php");
if((isset($_GET['class'])) && (isset($_GET['action'])))
{
  $class = str_replace('\\',"",$_GET['class']);
  $response = Response::error("Invalid Class: ".$class.".");
  switch($class) {
    case "form":
      require_once("../class/form.controller.php");
      $FormController = new FormController();
      $response = $FormController->run($_GET['action'],$_POST);
      break;
  }
}
else
{
  $response = Response::error("Malformed request.");
}


echo json_encode($response);
?>
