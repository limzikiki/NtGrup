<?php
ini_set('display_errors', 1);
if (gettype($_POST['name']) === "string" && gettype($_POST['email']) === "string" && gettype($_POST['message']) === "string") {
    $to = 'ntgrupa@gmail.com';
    $subject = "Письмо с сайта";
    $message = "Вам было оставленно письмо на сайте от " . $_POST['name'] . " email: " . $_POST['email'] . " текст письма:\r\n" . $_POST['message'];
    $headers  = "Content-type: text/html; charset=UTF-8 \r\n"; 
    $headers .= "Reply-To:\r\n".$_POST['email']; 
    if (mail($to, $subject, $message)) {
        echo 'succes';
    } else {
        echo 'fail';
    }
} else {
    echo 'fail';
}
