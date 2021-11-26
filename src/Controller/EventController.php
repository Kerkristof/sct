<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\EventCategory;
use App\Form\EventCategoryType;
use App\Repository\EventCategoryRepository;
use App\Entity\Event;
use App\Form\EventType;
use App\Repository\EventRepository;

/**
 * @Route("/admin")
 */
class EventController extends AbstractController
{
    /**
     * @Route("/event/index", name="event_index")
     */
    public function index(Request $request, EventCategoryRepository $event_category_repo,
    EventRepository $event_repo): Response
    {
        $event_categories = $event_category_repo->findAll();
        $events = $event_repo->findBy([], ['date' => 'DESC']);
        return $this->render('event/index.html.twig', [
          'event_categories' => $event_categories,
          'events' => $events
        ]);
    }

    /**
     * @Route("/event/category/create", name="event_category_create")
     * @Route("/event/category/update/{id}", name="event_category_update")
     * @param  [type]                 $event_category [description]
     * @param  Request                $request        [description]
     * @param  EntityManagerInterface $manager        [description]
     * @return [type]                                 [description]
     */
    public function category_create(EventCategory $event_category = null, Request $request, EntityManagerInterface $manager)
    {
      if (!$event_category)
      {
        $event_category = new EventCategory;
      }
      $form = $this->createForm(EventCategoryType::class, $event_category);
      $form->handleRequest($request);
      if ($form->isSubmitted() && $form-> isValid())
      {
        $manager->persist($event_category);
        $manager->flush($event_category);
        return $this->RedirectToRoute('event_index');
      }
      return $this->render('event/category_edit.html.twig', [
        'formCategory' => $form->createView(),
        'editMode' => $event_category-> getId() != null
      ]);
    }

    /**
     * @Route("/event/create", name="event_create")
     * @Route("/event/update/{id}", name="event_update")
     * @return [type] [description]
     */
    public function event_create(Event $event = null, Request $request, EntityManagerInterface $manager, EventCategoryRepository $category_repo )
    {
      if (!$event) {
        $event = new Event;
        $event->setAuthor($this->getUser())
              ->setCreatedAt(new \DateTime());
      }else {
        $event->setUpdatedAt(new \DateTime());
      }
      $categoryList  = $category_repo->findAll();
      $form = $this->createForm(EventType::class, $event, [
        'categoryList' => $categoryList
      ]);
      $form->handleRequest($request);
      if ($form->isSubmitted() && $form-> isValid())
      {
        $manager->persist($event);
        $manager->flush($event);
        return $this->RedirectToRoute('event_index');
      }
      return $this->render('event/event_edit.html.twig', [
        'formEvent' => $form->createView(),
        'editMode' => $event->getId() != null
      ]);
    }



}
