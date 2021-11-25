<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\EventCategory;
use App\Form\EventCategoryType;
use App\Repository\EventCategoryRepository;
use Doctrine\ORM\EntityManagerInterface;


class EventController extends AbstractController
{
    /**
     * @Route("event/index", name="event_index")
     */
    public function index(EventCategoryRepository $event_category_repo): Response
    {
        $event_categories = $event_category_repo->findAll();
        return $this->render('event/index.html.twig', [
          'event_categories' => $event_categories
        ]);
    }

    /**
     * @Route("event/category/create", name="event_category_create")
     * @Route("event/category/update/{id}", name="event_category_update")
     * @param  [type]                 $event_category [description]
     * @param  Request                $request        [description]
     * @param  EntityManagerInterface $manager        [description]
     * @return [type]                                 [description]
     */
    public function create(EventCategory $event_category = null, Request $request, EntityManagerInterface $manager)
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
}
