<?php

namespace App\Controller\dashboard;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Filesystem\Filesystem;
use App\Repository\EventRepository;
use App\Repository\EventCategoryRepository;
use App\Entity\Event;
use App\Form\EventType;
use App\Entity\EventFile;
use App\Form\EventFileType;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @Route("/admin")
 */
class EventCrudController extends AbstractController
{
  /**
   * @Route("/event/index", name="admin_event_index")
   */
  public function index(EventRepository $event_repo): Response
  {
      $events = $event_repo->findBy([], ['date' => 'DESC']);

      return $this->render('dashboard/event/index.html.twig', [
        'events' => $events
      ]);
  }
  /**
   * @Route("/event/create", name="admin_event_create")
   * @Route("/event/update/{id}", name="admin_event_update")
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
      return $this->RedirectToRoute('admin_event_index');
    }
    return $this->render('dashboard/event/edit.html.twig', [
      'formEvent' => $form->createView(),
      'editMode' => $event->getId() != null
    ]);
  }
  /**
   * @Route("/event/delete/{id}", name="admin_event_delete")
   * @param  Event                  $event   [description]
   * @param  EntityManagerInterface $manager [description]
   * @return [type]                          [description]
   */
  public function event_delete(Event $event, EntityManagerInterface $manager, Filesystem $file_system){
    foreach ($event->getEventFiles() as $event_file) {
      $pdf = $event_file->getFileName();
      $file_system->remove($this->getParameter('upload_directory').'/'.$pdf);
    }
    $manager->remove($event);
    $manager->flush($event);
    return $this->redirectToRoute('admin_event_index');
  }
  /**
   * @Route("/event/add_file/{id}", name="admin_event_add_file")
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
      return $this->RedirectToRoute('admin_event_index');
    }
    return $this->render('dashboard/event/add_file.html.twig', [
      'formEventFile' => $form->createView(),
    ]);
  }

  /**
   * @Route("/event/delete_file/{id}", name="admin_event_delete_file")
   * @param  EventFile $event_file [description]
   * @return [type]                [description]
   */
  public function delete_event_file(EventFile $event_file, EntityManagerInterface  $manager){
    $file_system = new Filesystem;
    $pdf = $event_file->getFileName();
    $file_system->remove($this->getParameter('upload_directory').'/'.$pdf);
    $manager->remove($event_file);
    $manager->flush($event_file);
    return $this->redirectToRoute('admin_event_index');
  }
}
