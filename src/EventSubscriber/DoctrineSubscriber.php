<?php

namespace App\EventSubscriber;

use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use App\Services\EmailService;

class DoctrineSubscriber implements EventSubscriberInterface
{
  private $email_service;

  public function __construct(EmailService $email_service)
  {
    $this->email_service = $email_service;
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
    $this->email_service->sendEmail($entity);
    return;
  }
}
