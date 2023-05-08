<?php
require_once('class.phpmailer.php');
$email=$_GET['email'];
$token='http://localhost/Cyjam/Views/verifierCompte.php?email='.$email;

//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

$mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch

$mail->IsSMTP(); // telling the class to use SMTP

try {
  $mail->Host       = "mail.yourdomain.com"; // SMTP server
  $mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
  $mail->SMTPAuth   = true;                  // enable SMTP authentication
  $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
  $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
  $mail->Port       = 465;                   // set the SMTP port for the GMAIL server
  $mail->isHTML(true);
  $mail->Username   = "mohamed.sandid@esprit.tn";  // GMAIL username
  $mail->Password   = "geainbsixwpbvfvr";            // GMAIL password
  $mail->AddReplyTo('mohamed.sandid@esprit.tn');
  $mail->AddAddress($email);
  $mail->SetFrom('mohamed.sandid@esprit.tn');
  $mail->Subject = 'Validated Email';
  echo $token;
  $mail->Body = 'Check Mail via this link : '.$token; // optional - MsgHTML will create an alternate automatically
  $mail->AltBody ="";
  
  $mail->Send();
    echo "Message Sent OK</p>\n";
    echo "<script type='text/javascript'>";
    echo "alert('You are registered! Validated your Email!');
    window.location.href='../SignIn.php';";
    echo "</script>";

} catch (phpmailerException $e) {
  echo $e->errorMessage(); //Pretty error messages from PHPMailer
} catch (Exception $e) {
  echo $e->getMessage(); //Boring error messages from anything else!
}

?>