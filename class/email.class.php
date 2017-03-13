<?php
  require_once("../config.php");
  class Email {
    static public function send($subject,$message,$sendTo = ""){
      $settings = emailSettings();
      $headers = "From: " . strip_tags($settings->sourceEmail) . "\r\n";
      $headers .= "Reply-To: ". strip_tags($settings->sourceEmail) . "\r\n";
      $headers .= "MIME-Version: 1.0\r\n";
      $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

      if($sendTo === "")
        $sendTo = $settings->defaultDest;

      return mail($sendTo,$subject,$message,$headers);
    }
  }
?>
