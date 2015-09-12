<?php

//error_reporting(E_ALL);
error_reporting(E_STRICT);
date_default_timezone_set('America/Toronto');
require_once('class.phpmailer.php');

/* include '../DBServices/BSSSQLOperation.php'; */

function SendMail($ToEmail, $ToName, $SubjectTexT, $BodyText){

mysql_connect(HOST, USERNAME, PASSWORD) or die(mysql_error());
mysql_select_db(DB) or die(mysql_error());

//get the Setup
$SQLSTRING = "SELECT id,emailhost,emailport,emailusername,emailpassword" . " FROM Setup";
$result = mysql_query($SQLSTRING);
$row = mysql_fetch_array($result, MYSQL_NUM);

$EmailHost  = $row[1];
$EmailPort = $row[2];
$EmailUserName  = $row[3];
$EmailPassword  = $row[4];


$mail             = new PHPMailer();

$mail->Host       = $EmailHost;
$mail->Port       = $EmailPort;
$mail->IsSMTP();                                // telling the class to use SMTP
$mail->SMTPDebug  = 2;                          // enables SMTP debug information (for testing)   1 = messages only 2 = errors and detailed messages
$mail->SMTPAuth   = true;                       // enable SMTP authentication
$mail->SMTPSecure = "tls";
 $mail->Username   = $EmailUserName;
$mail->Password   = $EmailPassword;

$mail->SetFrom($EmailUserName, 'BSSAdvWorkflow Admin');
// $mail->AddReplyTo("name@yourdomain.com","First Last");
$mail->Subject    = $SubjectTexT;
// $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
$mail->MsgHTML($BodyText . ' ');
$address = $ToEmail;
$mail->AddAddress($address, $ToName);

// $mail->AddAttachment("images/phpmailer.gif");      // attachment
// $mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

$MessageResult = "";

 if(!$mail->Send()) {
   $MessageResult =  "Mailer Error: " . $mail->ErrorInfo;
 } else {
   $MessageResult = "SUCCESS";
 }

    echo $MessageResult;

//$MessageResult = "SUCCESS";

return $MessageResult;

}
?>
