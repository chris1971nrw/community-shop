<?php
/**
 * E-Mail-Transporter-Klasse
 */

namespace CommunityShop;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\Exception;

class Transport
{
    private PHPMailer $mailer;

    public function __construct()
    {
        $this->mailer = new PHPMailer(true);
    }

    public function send(string $to, string $subject, string $body): bool
    {
        try {
            $this->mailer->isSMTP();
            $this->mailer->Host = 'smtp.example.com';
            $this->mailer->SMTPAuth = true;
            $this->mailer->Username = 'noreply@community-shop.de';
            $this->mailer->Password = 'smtp-password';
            $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $this->mailer->Port = 587;

            $this->mailer->setFrom('noreply@community-shop.de', 'Community Shop');
            $this->mailer->addAddress($to);
            $this->mailer->isHTML(true);
            $this->mailer->Subject = $subject;
            $this->mailer->Body = $body;

            return $this->mailer->send();
        } catch (Exception $e) {
            return false;
        }
    }
}
