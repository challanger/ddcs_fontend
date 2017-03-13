<?php
class Response {
  public static function normal($object,$status = "OK"){
    if(is_object($object))
    {
      $object->status = $status;
      return $object;
    }
    else
    {
      $send = new stdClass();
      $send->status = $status;
      $send->data = $object;
      return $send;
    }
  }

  public static function message($message) {
    $send = new stdClass();
    $send->status = "OK";
    $send->message = $message; 
    return $send;
  }

  public static function error($message,$code = "0") {
    $send = new stdClass();
    $send->status = "ERROR";
    $send->message = $message;
    $send->code = $code;
    return $send;
  }
}
?>
