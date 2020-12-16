<?php
require_once(__DIR__ . "/../../plugins/phpmailer-6.2.0/src/Exception.php");
require_once(__DIR__ . "/../../plugins/phpmailer-6.2.0/src/PHPMailer.php");
require_once(__DIR__ . "/../../plugins/phpmailer-6.2.0/src/SMTP.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once(__DIR__ . "/ImportUtil.php");
ImportUtil::importPhpModules();

/**
 * Class that provides mail utilities. This class uses the PHPMailer library to
 * send mails
 */
class MailUtil {
    
    /**
     * Send mail using PhpMailer
     * @param string $fromAddress
     * @param string $fromName
     * @param string $toAddress
     * @param string $toName
     * @param string $subject
     * @param string $message
     * @return string|\phpmailerException
     */
    public static function sendMail($fromAddress, $fromName, $toAddress, $toName, $subject, $message) {
        $mail = new PHPMailer(true);
        $mail->IsSMTP();
        try {
            $mail->Host = Config::MAIL_SMTP;
            $mail->SMTPAuth = true;
            $mail->Password = Config::MAIL_PASSWORD;
            $mail->SMTPSecure = Config::MAIL_TYPE;
            $mail->Port = Config::MAIL_PORT;
            $mail->Username = $fromAddress;
            $mail->CharSet = Config::MAIL_CHARSET;
            $mail->SetFrom($fromAddress, $fromName);
            $mail->AddReplyTo($fromAddress, $fromName);
            $mail->Subject = $subject;
            $mail->AddAddress($toAddress, $toName);
            $mail->MsgHTML($message);
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            $mail->Send();
            return "success";
        } catch (phpmailerException $e) {
            echo $e->errorMessage();
            return $e;
        }
    }
}
