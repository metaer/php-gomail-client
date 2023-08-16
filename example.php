<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require 'vendor/autoload.php';

const SMTP_SERVER_USERNAME = 'username'; //Необходимо заменить на реальный логин
const SMTP_SERVER_PASSWORD = 'password'; //Необходимо заменить на реальный пароль
CONST EMAIL_TO = 'example@example.com'; //Необходимо заменить на email получателя

try{
    $mail = new PHPMailer(true);

    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host       = 'smtp.mailer-demo.ru';
    $mail->SMTPAuth   = true;
    $mail->Username   = SMTP_SERVER_USERNAME;
    $mail->Password   = SMTP_SERVER_PASSWORD;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;
    $mail->CharSet    = "UTF-8";

    /*
     * Отправителя тоже можно заменить на своего.
     * Для этого нужно к своему домену добавить TXT-запись SPF вида
     * v=spf1 include:spf.mailer-demo.ru
     */
    $mail->setFrom('admin@mailer-demo.ru', 'Mailer-demo.ru');
    $mail->addAddress(EMAIL_TO);
    $mail->Subject = 'Тестовая тема';
    $mail->Body    = 'Тестовое тело письма';

    $mail->send();
    echo 'Письмо успешно отправлено';
} catch (Exception $e) {
    echo PHP_EOL, "Письмо не отправлено. Ошибка: {$e->getMessage()}", PHP_EOL;
}
