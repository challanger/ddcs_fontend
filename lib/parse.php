<?php
require_once('slider.php');

class Template {
  private $root_path;

  public function __construct($root_path = "/")
  {
    $this->root_path = $root_path;
  }
  public function parse($path,$template = "main") {
    $template = $this->loadTemplate($template);
    $content = $this->openContent($path);

    $template = str_replace("{{CONTENT}}",$content,$template);
    $template = str_replace("{{ROOT_PATH}}",$this->root_path,$template);
    return $template;
  }

  private function openContent($path) {
    $fileName = "content/$path.html";
    if(file_exists($fileName))
    {
      $fileObject = fOpen($fileName,'r');
      if($fileObject)
      {
        $template = fread($fileObject,filesize($fileName));
        $template = $this->parseSubTemplates($template);
        fClose($fileObject);
        return $template;
      }
      else
      {
        if($path != "404")
          return $this->openContent("404");
        else
          return "<p>Error: Can't find 404</p>";
      }
    }
    else if(file_exists("content/404.html"))
    {
      return $this->openContent("404");
    }
    else
    {
      return "<p>Error: Can't find 404</p>";
    }
  }

  private function parseSubTemplates($content){
    $content = preg_replace_callback('/\<template.+?\>\<\/template\>/',function($matches){
      $attributes = $this->parseSubTemplateAttributes($matches[0]);
      if(property_exists($attributes,'type')){
        switch($attributes->type){
          case "slider":
            $Slider = new Slider($this,$attributes->gallery);
            $matches[0] = $Slider->parse($matches[0]);
            break;
        }
      }
      return $matches[0];
    },$content);
    return $content;
  }

  public function parseSubTemplateAttributes($template){
    $xml = simplexml_load_string($template);
    return $xml->attributes();
  }

  public function loadTemplate($fileName) {
    $fileName = "templates/$fileName.html";
    $fileObject = fOpen($fileName,'r');
    if($fileObject)
    {
      $template = fread($fileObject,filesize($fileName));
      fClose($fileObject);
      return $template;
    }
    else
      return "<p>Error: No Template Found</p>";
  }
}
?>
