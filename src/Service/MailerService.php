<?php

namespace App\Service;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailerService
{

    private MailerInterface $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendNewsletterResponse(string $mail)
    {
        $email = (new TemplatedEmail())
            ->from('site.local@gmail.com')
            ->to($mail)
            ->subject('Accusé d\'inscription à la newsletter')
            ->htmlTemplate('mails/newsletter.html.twig')
            ->context(['mail' => $mail]);

        $this->sendMail($email);
    }


    private function sendMail(TemplatedEmail | Email $email){
        try {
            $this->mailer->send($email);
        }catch (Exception $exception){
            dump($exception->getMessage());
        }
    }
}