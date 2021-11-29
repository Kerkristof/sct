<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use App\Entity\EventCategory;
use App\Form\EventCategoryType;
use App\Repository\EventCategoryRepository;
use App\Entity\Event;
use App\Form\EventType;
use App\Repository\EventRepository;
use App\Entity\EventFile;
use App\Form\EventFileType;

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

    /**
     * @Route("/event/add_event_file/{id}", name="add_event_file")
     * @param Event                  $event   [description]
     * @param Request                $request [description]
     * @param EntityManagerInterface $manager [description]
     */
    public function add_event_file(Event $event, Request $request, EntityManagerInterface $manager, SluggerInterface $slugger){
      $event_file = new EventFile;
      $event_file->setEvent($event);
      $form = $this->createForm(EventFileType::class, $event_file);
      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()){
        /** @var UploadedFile $brochureFile */
        $pdf = $form->get('filename')->getData();

        if ($pdf) {
          $originalFilename = pathinfo($pdf->getClientOriginalName(), PATHINFO_FILENAME);
        // this is needed to safely include the file name as part of the URL
        $safeFilename = $slugger->slug($originalFilename);
        $newFilename = $safeFilename.'-'.uniqid().'.'.$pdf->guessExtension();

        // Move the file to the directory where brochures are stored
        try {
            $pdf->move(
                $this->getParameter('upload_directory'),
                $newFilename
            );
        } catch (FileException $e) {
            // ... handle exception if something happens during file upload
        }

        // updates the 'brochureFilename' property to store the PDF file name
        // instead of its contents
        $event_file->setName($originalFilename);
        $event_file->setFileName($newFilename);
        $manager->persist($event_file);
        $manager->flush($event_file);

        }
        return $this->RedirectToRoute('event_index');
      }
      return $this->render('event/add_event_file.html.twig', [
        'formEventFile' => $form->createView(),
      ]);
    }



}
