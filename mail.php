<?php

class Response {
  public $status = "";
  public $name = "";
  public $errors = [];
}

class Email {
  public $to = "casemorris@hotmail.com";
  public $subject = "Email from Resume Site";
  public $from = "";
  public $body = "";
}
// define variables and set to empty values
$nameErr = $emailErr = "";
$name = $email = $comment = "";
$isName = $isEmail = $isComment = false;

// Create a response
$response = new Response();

// Creat an email
$email = new Email();

if ((empty($_POST["name"])) || (!filter_var($_POST['name'], FILTER_SANITIZE_STRING)))  {

  $nameErr = "Name is required!";
  array_push($response->errors,$nameErr);
  $response->status = "error";

}
else {
    $response->name = $_POST["name"];
    $response->status = "ok";
}

if((empty($_POST["email"])) || (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))){
  $emailErr = "Email is required or invalid format!";
  array_push($response->errors, $emailErr);
  $response->status = "error";
}
else{
  $email->from = $_POST['email'] ;
}

if ((empty($_POST["comment"])) || (!filter_var($_POST['comment'], FILTER_SANITIZE_STRING))){
  $commentErr = "Missing comment";
  array_push($response->errors, $commentErr);
  $response->status = "error";
}
else
{
  $email->body = $_POST['comment'];
}


if (($isName)&&($isEmail)&&($isComment))
{
	// Building message
  $body = "From: $email->from \nName: $email->name \nComment: $email->body";
  // Send message to email
  mail($email->to, $email->subject,  $body);
}

echo json_encode($response);

?>
