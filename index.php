<?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  require_once("config.php");
  $root_path = getRootPath();
  $root_dir = "";

  require_once("lib/parse.php");
  require_once("lib/path.php");
  $path = new Path();
  $template = new Template($root_path);
  //echo "test";
  echo $template->parse($path->get());
?>
