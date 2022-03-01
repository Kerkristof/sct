<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\DateTime;
use App\Repository\EventRepository;
use App\Repository\BlogCommentRepository;
use App\Repository\TagRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\ContactMessage;
use App\Entity\Statistic;
use App\Repository\StatisticRepository;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(BlogCommentRepository $blog_repo, EventRepository $event_repo, Request $request,
    EntityManagerInterface $manager, StatisticRepository $statistic_repo): Response
    {
      // get ip adress from client
      $ip_adress = $request->getClientIp();
      // check if this ip adress already exists in DB
      $statistic = $statistic_repo->findOneBy(['ip_adress' => $ip_adress]);
      $today = new DateTime();
      // if ip adress already exists in DB AND if lastLog is inf at today => count is increased by 1 and lastLog is updated at today
      if ($statistic)
      {
        if ($statistic->getLastLog() < $today) {
          $statistic->setLastLog($today)
                    ->setLogCount($statistic->getLogCount() + 1);
        }
      }
      // if ip adress is new. A new statistic entity is ceated.
      else
      {
        $statistic = new Statistic;
        $statistic->setIpAdress($ip_adress)
        ->setLastLog(new \DateTime())
        ->setLogCount(1);
        $manager->persist($statistic);
        $manager->flush($statistic);
      }

      $events = $event_repo->findBy([], ['date' => 'DESC'], 20);
      $last_blog_comments = $blog_repo->findBy([],['createdAt' => 'DESC'], 5);
      return $this->render('home/index.html.twig', [
          'blog_comments' => $last_blog_comments,
          'events' => $events
      ]);
    }
    /**
     * @Route("/useful_link", name="useful_link")
     * @return Response [description]
     */
    public function usefulLink(): Response
    {
      return $this->render('home/useful_link.html.twig');
    }

    /**
     * @Route("/contact_us", name="contact_us")
     * @return Response [description]
     */
    public function contactUs (): Response
    {
      return $this->render('home/contact_us.html.twig');
    }

    /**
     * @Route("/contact_post", name="contact_post")
     * @return Response [description]
     */
    public function ContactPost(Request $request, EntityManagerInterface $entityManager): Response
    {
      $contact_message = new ContactMessage();
      $contact_message->setCreatedAt(new \DateTime())
                      ->setFirstName($request->request->get('first_name'))
                      ->setName($request->request->get('name'))
                      ->setEmail($request->request->get('email'))
                      ->setSubject($request->request->get('subject'))
                      ->setContent($request->request->get('content'));
      $entityManager->persist($contact_message);
      $entityManager->flush();
      return $this->redirectToRoute('home');
    }
    /**
     * @Route("/legal_mention", name="legal_mention")
     * @return Response [description]
     */
    public function legalMention(): Response
    {
      return $this->render('home/legal_mention.html.twig');
    }
    /**
     * @Route("/activities", name="activities")
     * @return [type] [description]
     */
    public function activities()
    {
      return $this->render('home/activities.html.twig');
    }
    /**
     * @Route("/galery", name="galery")
     * @return [type] [description]
     */
    public function galery(TagRepository $repo)
    {
      $tags = $repo->findAll();
      return $this->render('home/galery.html.twig', [
        'tags' => $tags
      ]);
    }
}
