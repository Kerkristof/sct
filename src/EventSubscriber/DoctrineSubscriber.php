<?php

namespace App\EventSubscriber;

use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;
use App\Entity\Event;
use App\Entity\BlogComment;
use App\Entity\ContactMessage;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use App\Services\EmailService;
use App\Repository\UserRepository;
use SebastianBergmann\CodeCoverage\Driver\PHPDBG;



class DoctrineSubscriber implements EventSubscriberInterface
{
  private $email_service;
  private $user_repo;

  public function __construct(EmailService $email_service, UserRepository $user_repo)
  {
    $this->email_service = $email_service;
    $this->user_repo = $user_repo;
  }

  // this method can only return the event names; you cannot define a
  // custom method name to execute when each event triggers
  public function getSubscribedEvents(): array
  {
      return [
          Events::postPersist,
      ];
  }
  public function postPersist(LifecycleEventArgs $args): void
  {
      $this->emailNotifyer('persist', $args);
  }


  private function emailNotifyer(string $action, LifecycleEventArgs $args): void
  {
    $entity = $args->getObject();
    if ($entity instanceof BlogComment) {
      // SEND AN EMAIL TO MEMBER WHEN A NEW BLOG IS PUBLISHED
      $parameters = [
        'subject' => 'Nouveau message sur le blog',
        'content' => $entity->getAuthor()->getFirstname() . " " . $entity->getAuthor()->getName() ." vient de publier un nouveau post https://www.surfcastingturballais.fr/login ",
        'role' => 'ROLE_MEMBER',
        'recipients' => $this->user_repo->findAll(),
      ];
      $this->email_service->sendEmail($parameters);
    }
    if ($entity instanceof Event) {
      // SEND AN EMAIL TO MEMBER WHEN A NEW EVENT IS PUBLISHED
      $parameters = [
        'subject' => 'Nouvel évenement sur le site',
        'content' => $entity->getAuthor()->getFirstname() . " " . $entity->getAuthor()->getName() ." vient de publier un nouvel événement https://www.surfcastingturballais.fr/login ",
        'role' => 'ROLE_MEMBER',
        'recipients' => $this->user_repo->findAll(),
      ];
      $this->email_service->sendEmail($parameters);
    }
    if ($entity instanceof ContactMessage) {
      // SEND EMAIL TO ADMIN WHEN A CONTACTMESSAGE IS RECEIVED
      $parameters = [
        'subject' => 'Nouvelle demande de contact reçue',
        'content' =>"De " . $entity->getFirstname() . " " . $entity->getName() . " / email : " .
        $entity->getEmail() . " / message: " . $entity->getContent() . " https://www.surfcastingturballais.fr/login ",
        'role' => 'ROLE_ADMIN',
        'recipients' => $this->user_repo->findAll(),
      ];
      $this->email_service->sendEmail($parameters);
    }
    return;
  }
}
