<?php

require("/usr/share/php/libphp-phpmailer/src/PHPMailer.php");
require("/usr/share/php/libphp-phpmailer/src/SMTP.php");

$mail = new PHPMailer\PHPMailer\PHPMailer();
   $mail->IsSMTP(); // enable SMTP

   
   $mail->SMTPAuth = true; // authentication enabled
   //$mail->SMTPDebug = 2;
   $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
   $mail->Host = "reko.opheim.as";
   $mail->Port = 465; // or 587
   $mail->IsHTML(true);
   $mail->CharSet = 'UTF-8';

  
   $mail->Username = "noreply@reko.opheim.as";
   $mail->Password = "^c,Mq3Gx!#$%t[9";
   $mail->SetFrom("noreply@reko.opheim.as");
   
    ?>