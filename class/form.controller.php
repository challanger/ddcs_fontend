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
}
?>