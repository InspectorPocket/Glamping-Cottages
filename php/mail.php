<?php
//error_reporting(-1);
//ini_set('display_errors', 'On');
//set_error_handler("var_dump");



$name = $_POST['name'];
$visitor_email = $_POST['email'];
$phone = $_POST['phone'];
$news = $_POST['news'];
$message = $_POST['message'];

//Validate first
if(empty($name)||empty($visitor_email)) 
{
    echo "Please enter your name and email address!";
    exit;
}

if(IsInjected($visitor_email))
{
    echo "Check your email is correct!";
    exit;
}

$email_from = '';//<== update the email address
$email_subject = "Message From Website: Contact Page";
$email_body = "From: $name \nEmail: $visitor_email \nPhone Number: $phone\n\n$news\n\n". 
    "$message \n\n".
    "Emailed to: \n".
    
$to = "";//<== update the email address
$headers = 'From: ' . $_POST['name'] . ' <>' . "\r\n" .
    "Reply-To: $visitor_email \r\n" .
    'X-Mailer: PHP/' . phpversion();
//Send the email!
mail($to,$email_subject,$email_body,$headers);
//done. redirect to thank-you page.
header('Location: thank-you.html');
exit();
echo "working";


// Function to validate against any email injection attempts
function IsInjected($str)
{
  $injections = array('(\n+)',
              '(\r+)',
              '(\t+)',
              '(%0A+)',
              '(%0D+)',
              '(%08+)',
              '(%09+)'
              );
  $inject = join('|', $injections);
  $inject = "/$inject/i";
  if(preg_match($inject,$str))
    {
    return true;
  }
  else
    {
    return false;
  }
}
   
?> 
