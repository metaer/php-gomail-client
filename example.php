<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

// В качестве smtp-клиента скрипт использует библиотеку https://github.com/PHPMailer/PHPMailer
// Подключить через composer: "composer require phpmailer/phpmailer"

require 'vendor/autoload.php';

const SMTP_SERVER_USERNAME = 'username'; // Необходимо заменить на реальный логин
const SMTP_SERVER_PASSWORD = 'password'; // Необходимо заменить на реальный пароль
const EMAIL_TO = 'example@example.com'; // Необходимо заменить на email получателя
const HOST = 'smtp.example.com'; // Необходимо заменить на хост smtp-сервера
const PORT = 587; // Необходимо заменить на порт smtp-сервера
const EMAIL_FROM = 'example@example.com'; // Необходимо заменить на email отправителя

try{
    $mail = new PHPMailer(true);

    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host       = HOST;
    $mail->SMTPAuth   = true;
    $mail->Username   = SMTP_SERVER_USERNAME;
    $mail->Password   = SMTP_SERVER_PASSWORD;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = PORT;
    $mail->CharSet    = "UTF-8";

    /*
     * Отправителя тоже можно заменить на своего.
     * Для этого нужно к своему домену добавить TXT-запись SPF вида
     * v=spf1 include:spf.mailer-demo.ru
     */
    $mail->setFrom(EMAIL_FROM, ucfirst(explode('@', EMAIL_FROM)[1]));
    $mail->addAddress(EMAIL_TO);
    $mail->Subject = 'Тестовая тема';
    $mail->Body    = 'Тестовое тело письма';
    $mail->XMailer = 'php client lib';

    $mail->send();
    echo 'Письмо успешно отправлено', PHP_EOL;
} catch (Exception $e) {
    echo PHP_EOL, "Письмо не отправлено. Ошибка: {$e->getMessage()}", PHP_EOL;
}
