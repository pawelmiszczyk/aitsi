<?php
if(isset($_POST['submit'])) {
  $to = $_POST['email']; // adres e-mail odbiorcy
  $subject = "Nowy subskrybent newslettera"; // temat wiadomości
  $email = "info@wypozyczalniasamochodow.com"; // adres e-mail nadawcy
  $message = "Nowy subskrybent: $email"; // treść wiadomości
  
  // nagłówki wiadomości
  $headers = "From: $email \r\n";
  $headers .= "Reply-To: $email \r\n";
  
  // wysłanie wiadomości e-mail
  $success = mail($to, $subject, $message, $headers);
}
?>
