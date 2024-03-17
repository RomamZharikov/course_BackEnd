<?php
$subject = "roman.zharikov26@gmail.com";
echo '============' . "\n";
echo $subject . "\n";
echo '============' . "\n";
$firstName = 'Roman';
$text1 = "firstName: $firstName" . "\n";
$text2 = 'Hello World!';
$message = $text1 . $text2;
echo $message;
$headers = "From: $subject";
mail($subject, $firstName, $message, $headers);

