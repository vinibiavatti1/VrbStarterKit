<?php
require_once(__DIR__ . "/../../plugins/phpmailer-5.2.15/PHPMailerAutoload.php");
require_once(__DIR__ . "/../services/ImportService.php");
ImportService::importPhpModules();

/**
 * Service that provides mail utilities. This service uses the PHPMailer lib.
 */
class MailService {
    
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
