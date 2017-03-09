<?php
  class Slider {
    private $gallery;
    private $Template;

    public function __construct($_Template,$_gallery)
    {
      $this->gallery = $_gallery;
      $this->Template = $_Template;
    }

    public function parse($content){
      $slidesHtml = "";
      foreach($this->getSlides() as $slide){
        $slideHtml = $this->Template->loadTemplate("slide");
        $slideHtml = str_replace("{FILE}",$slide,$slideHtml);
        $slidesHtml.=$slideHtml;
      }

      $sliderHtml = $this->Template->loadTemplate("slider");
      $sliderHtml = str_replace("{SLIDES}",$slidesHtml,$sliderHtml);
      $sliderHtml = str_replace("{GALLERY}",$this->gallery,$sliderHtml);

      return $sliderHtml;
    }

    public function download($fileName){
      $file = "../download/".$this->gallery."/".$fileName;
      if (file_exists($file)) {
          header('Content-Description: File Transfer');
          header('Content-Type: application/octet-stream');
          header('Content-Disposition: attachment; filename="'.$fileName.'"');
          header('Expires: 0');
          header('Cache-Control: must-revalidate');
          header('Pragma: public');
          header('Content-Length: ' . filesize($file));
          readfile($file);
          exit;
      }
      else {
        echo "<p>File not found $file </p>";
      }
    }

    private function getSlides(){
      $files = scandir("galleries/".$this->gallery."/");
      $slides = array();
      foreach($files as $fileName){
        switch(strtolower($this->getFileExtention($fileName))){
          case "jpg":
          case "jpeg":
          case "png":
          case "gif":
              array_push($slides,$fileName);
              break;
        }
      }
      return $slides;
    }

    private function getFileExtention($fileName) {
      $parts = explode(".",$fileName);
      if(count($parts) > 0)
        return $parts[count($parts) - 1];
      else
        return $fileName;
    }

  }
?>
