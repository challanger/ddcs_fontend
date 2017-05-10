<?php
require_once("basic.controller.php");
require_once("response.class.php");
require_once("email.class.php");
class FormController extends BasicController{
  public function run($action,$data){
    switch($action){
      case 'submit':
        return $this->submitForm($_GET["form"],$data);
        break;
      default:
        return parent::run($action,$data);
        break;
    }
  }

  private function submitForm($form,$data){
      switch($form){
          case 'contact-us-form':
            return $this->contact($data);
            break; 
          case 'exec-form':
            return $this->contactExec($data);
            break; 
          default: 
            return Response::error("Invalid form.");
            break;
      }
  }

  private function contact($data){
    if(isset($_POST['email']))
    {
      $message = "<p>Name: ".$_POST['name']. "</p>";
      $message.="<p>Email: ".$_POST['email']."</p>";
      $message.="<p>Subject: ".$_POST['subject']."</p>";
      $message.="<p>Comment: ".$_POST['body']."</p>";
      Email::send("Contact: " . $_POST['name'],$message);
      return Response::message("Thank you for your comment we will get back to you shortly.");
    }
    else
    {
      return Response::error("Missing input data.");
    }

  }

  private function contactExec($data){
    if(isset($_POST['email']))
    {
      $sendTo = "aaron.dune2000@gmail.com";
      $messageExtra = "<p>This message was intended for exec user id: " + $_POST["team-member"] + "</p>";
      switch((int)$_POST["team-member"])
      {
        case 1:   //Frank Smaglinskie 
          $sendTo = "frank@durhamdivers.com";
          $messageExtra = "";
          break; 
        case 2:   //Greg Wright
          $sendTo = "gwright@durhamdivers.com";
          $messageExtra = "";
          break; 
        case 3:   //Brian Pallock
          $sendTo = "scuba@divesource.com";
          $messageExtra = "";
          break; 
        case 4:   //Greg Johnson 
          $sendTo = "gjohnson@durhamdivers.com";
          $messageExtra = "";
          break; 
      }

      $message = "<p>Name: ".$_POST['name']. "</p>";
      $message.="<p>Email: ".$_POST['email']."</p>";
      $message.="<p>Subject: ".$_POST['subject']."</p>";
      $message.="<p>Comment: ".$_POST['body']."</p>";
      $message.=$messageExtra; 
      Email::send("Contact: " . $_POST['name'],$message,$sendTo);
      return Response::message("Thank you for your comment we will get back to you shortly.");
    }
    else
    {
      return Response::error("Missing input data.");
    }

  }
}
?>
