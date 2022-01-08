<?php

namespace App\EventSubscriber;

use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;
use App\Entity\Event;
use App\Entity\BlogComment;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use App\Services\EmailService;
use App\Repository\UserRepository;



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
        'content' => $entity->getAuthor()->getFirstname() . " " . $entity->getAuthor()->getName() ." vient de publier un nouveau post",
        'role' => 'ROLE_MEMBER',
        'recipients' => $this->user_repo->findAll(),
      ];
      $this->email_service->sendEmail($parameters);
    }
    if ($entity instanceof Event) {
      // SEND AN EMAIL TO MEMBER WHEN A NEW EVENT IS PUBLISHED
      $parameters = [
        'subject' => 'Nouvel évenement sur le site',
        'content' => $entity->getAuthor()->getFirstname() . " " . $entity->getAuthor()->getName() ." vient de publier un nouvel événement",
        'role' => 'ROLE_MEMBER',
        'recipients' => $this->user_repo->findAll(),
      ];
      $this->email_service->sendEmail($parameters);
    }
    return;
  }
}
