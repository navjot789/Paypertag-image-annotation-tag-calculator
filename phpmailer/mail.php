<?php
use PHPMailer\PHPMailer\PHPMailer;
require 'autoload.php';
$mail = new PHPMailer;

include "../inc/email_content.php";

$mail->isSMTP();
$mail->SMTPDebug = 2;

$mail->Host = 'mx1.hostinger.com';
$mail->Port = 587;
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'tls';
$mail->Username = 'support@paypertag.tk';
$mail->Password = '74587458';

$mail->setFrom('support@paypertag.tk', '');
$mail->addReplyTo('support@paypertag.tk', '');
$mail->addAddress('test-aphqj@mail-tester.com', '');
$mail->Subject = 'This means that emails work fine.';
$mail->msgHTML($content);

if (!$mail->send()) {
echo 'error: ' . $mail->ErrorInfo;
} else {
echo 'message sent';
}
//if (!$mail->send()) {
// echo $message_error . $mail->ErrorInfo;
//} else {
// echo $message_send;
//}

?>