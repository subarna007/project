<?php
$to = "subarnadahal@email.com";
$subject = "My subject";
$txt = "Hello world!";
$headers = "From: subarnadahal@gmail.com" . "\r\n" .
"CC: subarnadahal@gmail.com";

mail($to,$subject,$txt,$headers);
?>