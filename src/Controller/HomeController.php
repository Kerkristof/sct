<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;
use App\Repository\EventRepository;
use App\Repository\BlogCommentRepository;
use App\Repository\TagRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\ContactMessage;
use App\Entity\Statistic;
use App\Repository\StatisticRepository;
use App\Repository\ArticleRepository;
use App\Repository\SponsorRepository;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ArticleRepository $article_repo, Request $request,
    EntityManagerInterface $manager, StatisticRepository $statistic_repo, SponsorRepository $sponsor_repo): Response
    {
      // sponsors
        $sponsors = $sponsor_repo->findAll();
      // get ip adress from client
      $ip_adress = $request->getClientIp();
      // check if this ip adress already exists in DB
      $statistic = $statistic_repo->findOneBy(['ip_adress' => $ip_adress]);
      $today = new \DateTime();
      // if ip adress already exists in DB AND if lastLog is inf at today => count is increased by 1 and lastLog is updated at today
      if ($statistic)
      {
        if (intval(date_diff($today, $statistic->getLastLog())->format('%d')) > 0)
        {
          $statistic->setLastLog($today)
                    ->setLogCount($statistic->getLogCount() + 1);
          $manager->persist($statistic);
          $manager->flush($statistic);
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
      $online_articles = $article_repo->findBy(['online'=>true]);
      return $this->render('home/index.html.twig', [
          'online_articles' => $online_articles,
          'sponsors' => $sponsors
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
     * @Route("/general_condition", name="general_condition")
     * @return Response [description]
     */
    public function generalCondition(): Response
    {
      return $this->render('home/general_condition.html.twig');
    }
    /**
     * @Route("/personal_data_policy", name="personal_data_policy")
     * @return Response [description]
     */
    public function personalDataPolicy(): Response
    {
      return $this->render('home/personal_data_policy.html.twig');
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
    /**
    * @Route("/sponsor", name="sponsor")
     * @param  SponsorRepository $repo [description]
     * @return [type]                  [description]
     */
    public function sponsor(SponsorRepository $repo)
    {
      $ponsors = $repo->findBy(['active'=>true]);
      return $this->render('home/sponsor.html.twig', [
        'sponsors' => $ponsors
      ]);
    }
}
