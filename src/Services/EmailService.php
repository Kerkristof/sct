<?php
namespace App\Services;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use App\Services\GrantedService;

class EmailService
{
  private $mailer;
  private $granted_service;

/**
 * @param MailerInterface $mailer          [description]
 * @param GrantedService  $granted_service [description]
 */
  public function __construct(MailerInterface $mailer, GrantedService $granted_service)
  {
    $this->mailer = $mailer;
    $this->granted_service = $granted_service;
  }

  public function sendEmail($parameters) : void
  {
    $email = (new Email())
    ->from('surfcastingturballais@lanco.ovh')
    ->subject($parameters['subject'])
    ->text($parameters['content']);
    foreach ($parameters['recipients'] as $recipient) {
      if ($this->granted_service->isGranted($recipient, $parameters['role'] )) {
        $email->addTo($recipient->getEmail());
      }
    }
    $this->mailer->send($email);
  }
}
