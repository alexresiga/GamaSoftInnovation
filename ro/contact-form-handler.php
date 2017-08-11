<?php 
$errors = '';
$myemail = 'office@raftportpalet.ro';
if(empty($_POST['contactname'])  || 
   empty($_POST['email']) || 
    empty($_POST['subj']) || 
   empty($_POST['message']))
{
    $errors .= "\n Error: Toate campurile sunt necesare.";
}

$name = $_POST['contactname']; 
$email_address = $_POST['email'];
$subj=$_POST['subj']; 
$message = $_POST['message']; 

if (!preg_match(
"/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i", 
$email_address))
{
    $errors .= "\n Error: Adresa de email invalida.";
}

if( empty($errors))
{
	$to = $myemail; 
	$email_subject = "[Contact via raftportpalet.ro]: $subj";
	$email_body = "You have received a new message. ".
	" Here are the details:\n Name: $name \n Email: $email_address \n Subiect: $subj Message \n $message"; 
	$headers .= sprintf( 'Disposition-Notification-To: %s%s', $email_address, PHP_EOL );
	$headers = "From: $myemail\n"; 
	$headers .= "Reply-To: $email_address";
	mail($to,$email_subject,$email_body,$headers);
	header('Location: contact-form-thank-you.html');
} 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
<head>
	<title>Contact form handler</title>
</head>

<body>
<?php
echo nl2br($errors);
?>


</body>
</html>