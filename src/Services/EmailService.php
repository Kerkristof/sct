<?php
namespace App\Services;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use App\Services\GrantedService;
use App\Entity\Event;
use App\Entity\BlogComment;
use App\Entity\ContactMessage;
use App\Repository\UserRepository;

class EmailService
{
  private $mailer;
  private $granted_service;
  private $user_repo;

 /**
  * @param MailerInterface $mailer          [description]
  * @param GrantedService  $granted_service [description]
  * @param UserRepository  $user_repo       [description]
  */
  public function __construct(MailerInterface $mailer, GrantedService $granted_service, UserRepository $user_repo)
  {
    $this->mailer = $mailer;
    $this->granted_service = $granted_service;
    $this->user_repo = $user_repo;
  }

  public function sendEmail($entity) : void
  {
    $recipients = $this->user_repo->findAll();
    $email = (new TemplatedEmail());

    if ($entity Instanceof ContactMessage) {
      $email->from('surfcastingturballais@lanco.ovh')
            ->subject('Une nouvelle demande de renseignement à consulter')
            ->htmlTemplate('email_template/contact_message_notification.html.twig')
            ->context([
              'entity' => $entity,
            ]);
      foreach ($recipients as $recipient) {
        if ($this->granted_service->isGranted($recipient, 'ROLE_ADMIN' )) {
          $email->addTo($recipient->getEmail());
        }
      }
      $this->mailer->send($email);
    }

    if ($entity Instanceof BlogComment) {
      $email->from('surfcastingturballais@lanco.ovh')
      ->subject('Un nouveau message vient d\'être publié sur le forum')
      ->htmlTemplate('email_template/blog_comment_notification.html.twig')
      ->context([
        'entity' => $entity,
      ]);
      foreach ($recipients as $recipient) {
        if ($this->granted_service->isGranted($recipient, 'ROLE_MEMBER' )) {
          $email->addTo($recipient->getEmail());
        }
      }
      $this->mailer->send($email);
    }
    if ($entity Instanceof Event) {
      $email->from('surfcastingturballais@lanco.ovh')
            ->subject('Un nouvel événement vient d\'être publié sur le site')
            ->htmlTemplate('email_template/event_notification.html.twig')
            ->context([
              'entity' => $entity,
            ]);
      foreach ($recipients as $recipient) {
        if ($this->granted_service->isGranted($recipient, 'ROLE_MEMBER' )) {
          $email->addTo($recipient->getEmail());
        }
      }
      $this->mailer->send($email);
    }

    return;
  }
}
