<?php

namespace Service;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '/var/www/html/fuel/vendor/PHPMailer/src/Exception.php';
require '/var/www/html/fuel/vendor/PHPMailer/src/PHPMailer.php';
require '/var/www/html/fuel/vendor/PHPMailer/src/SMTP.php';

class Email
{
    public static function send($user, $subject, $message)
    {
        $mail = new PHPMailer(true);

        $email = 'admin@weponews.com';
        $email_password = 'Buingoclam1.';

        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.hostinger.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = $email;
            $mail->Password   = $email_password;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;

            $mail->setFrom($email, 'Mailer');
            $mail->addAddress($user->email, $user->username);

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $message;

            $mail->send();
            return 'Mail has been sent';
        } catch (Exception $e) {
            return "Mail could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}