<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\DateTime;
use App\Repository\EventRepository;
use App\Repository\BlogCommentRepository;

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
}
