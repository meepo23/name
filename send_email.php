<?php
$to = "nikitaburkas23@gmail.com";
$message = "Уважаемый(ая) " . $_POST['name'] . ",\n\n";
$message .= " успешно отправлено.\n\n";
$message .= "С уважением,\nВаш ресторан";
$headers = "From: 
codeelo.test.smtp@gmail.com";

mail($to, $subject, $message, $headers);
?>