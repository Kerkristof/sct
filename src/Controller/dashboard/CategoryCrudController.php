<?php

namespace App\Controller\dashboard;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\EventCategoryRepository;
use App\Entity\EventCategory;
use App\Form\EventCategoryType;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @Route("/admin")
 */
class CategoryCrudController extends AbstractController
{

  /**
   * @Route("/category/index", name="admin_category_index")
   */
  public function index(EventCategoryRepository $event_category_repo): Response
  {
      $event_categories = $event_category_repo->findAll();
      return $this->render('dashboard/category/index.html.twig', [
        'event_categories' => $event_categories,
      ]);
  }

  /**
   * @Route("/category/create", name="admin_category_create")
   * @Route("/category/update/{id}", name="admin_category_update")
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
      return $this->RedirectToRoute('admin_category_index');
    }
    return $this->render('dashboard/category/edit.html.twig', [
      'formCategory' => $form->createView(),
      'editMode' => $event_category-> getId() != null
    ]);
  }

}
