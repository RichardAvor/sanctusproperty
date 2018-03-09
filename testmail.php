<?php
$to      = 'mr.aryee@gmail.com';
$subject = 'the subject';
$message = 'hello';
$headers = 'From: info@sanctuspropertygroup.com' . "\r\n" .
    'Reply-To: info@sanctuspropertygroup.com' . "\r\n" .
    "To: $to\r\n";
    'X-Mailer: PHP/' . phpversion();


mail($to, $subject, $message, $headers);
?>