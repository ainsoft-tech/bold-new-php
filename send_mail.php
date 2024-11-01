<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $to = "aliihsannasli@hotmail.com";
    $subject = $_POST['konu'];
    $message = $_POST['mesaj'];
    $headers = "From: " . $_POST['email'] . "\r\n";
    $headers .= "Reply-To: " . $_POST['email'] . "\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    if(mail($to, $subject, $message, $headers)) {
        header('Location: index.php?mail=success');
    } else {
        header('Location: index.php?mail=error');
    }
}