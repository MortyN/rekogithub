<?php

require("/usr/share/php/libphp-phpmailer/src/PHPMailer.php");
require("/usr/share/php/libphp-phpmailer/src/SMTP.php");

$mail = new PHPMailer\PHPMailer\PHPMailer();
   $mail->IsSMTP(); // enable SMTP

   $mail->SMTPDebug = 2; // debugging: 1 = errors and messages, 2 = messages only
   $mail->SMTPAuth = true; // authentication enabled
   $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
   $mail->Host = "reko.opheim.as";
   $mail->Port = 465; // or 587
   $mail->IsHTML(true);
   $mail->SetLanguage("en", 'includes/phpMailer/language/');

  
   $mail->Username = "noreply@reko.opheim.as";
   $mail->Password = "rekodev69";
   $mail->SetFrom("noreply@reko.opheim.as");
   
    ?>