<?php

require("/usr/share/php/libphp-phpmailer/src/PHPMailer.php");
require("/usr/share/php/libphp-phpmailer/src/SMTP.php");

$mail = new PHPMailer\PHPMailer\PHPMailer();
   $mail->IsSMTP(); // enable SMTP

   
   $mail->SMTPAuth = true; // authentication enabled
   $mail->SMTPDebug = 2;
   $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
   $mail->Host = 'smtp.gmail.com';
   $mail->Port = 587;
   
   $mail->IsHTML(true);
   $mail->CharSet = 'UTF-8';

  
   $mail->Username = "rekodevtest@gmail.com";
   $mail->Password = "Rekodevgruppe69!";
   $mail->SetFrom("rekodevtest@gmail.com");
   
    ?>