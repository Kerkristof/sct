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
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\ContactMessage;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(BlogCommentRepository $blog_repo, EventRepository $event_repo): Response
    {
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
    public function galery()
    {
      return $this->render('home/galery.html.twig');
    }
}
