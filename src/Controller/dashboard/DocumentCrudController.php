<?php

namespace App\Controller\dashboard;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Filesystem\Filesystem;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\DocFolder;
use App\Repository\DocFolderRepository;
use App\Form\DocFolderType;
use App\Entity\DocFile;
use App\Repository\DocFileRepository;
use App\Form\DocFileType;

/**
 * @Route("/admin")
 */
class DocumentCrudController extends AbstractController
{
  /**
   * @Route("/document/index", name="admin_doc_folder_index")
   * @return Response [description]
   */
  public function index(DocFolderRepository $repo): Response
  {
      $folders = $repo->findAll();
      return $this->render('dashboard/document/index.html.twig', [
          'folders' => $folders
      ]);
  }

  /**
   * @Route("/doc_folder/create", name="admin_doc_folder_create")
   * @Route("/doc_folder/update/{id}", name="admin_doc_folder_update")
   * @param  DocFolder              $folder  [description]
   * @param  Request                $request [description]
   * @param  EntityManagerInterface $manager [description]
   * @return Response                        [description]
   */
  public function create(DocFolder $folder=null, Request $request, EntityManagerInterface $manager): Response
  {
    if (!$folder) {
      $folder = new DocFolder;
    }
    $form = $this->createForm(DocFolderType::class, $folder);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $manager->persist($folder);
      $manager->flush($folder);
      return $this->RedirectToRoute('admin_doc_folder_index');
    }
    return $this->render('dashboard/document/edit.html.twig', [
      'formFolder' => $form->createView(),
      'editMode' => $folder->getId() !=null
    ]);
  }
  /**
   * @Route("/doc_folder/delete/{id}", name="admin_doc_folder_delete")
   * @param  DocFolder              $folder  [description]
   * @param  EntityManagerInterface $manager [description]
   * @return Response                        [description]
   */
  public function delete(DocFolder $folder, EntityManagerInterface $manager):Response
  {
    $manager->remove($folder);
    $manager->flush($folder);
    return $this->RedirectToRoute('admin_doc_folder_index');
  }
  /**
   * @Route("/doc_folder/show/{id}", name="admin_doc_folder_show")
   * @param  DocFolder $folder [description]
   * @return Response          [description]
   */
  public function show(DocFolder $folder):Response
  {
    return $this->render('dashboard/document/show.html.twig', [
      'folder' => $folder
    ]);
  }
  /**
   * @Route("/doc_folder/add_doc_file/{id}", name="admin_doc_folder_add_doc_file")
   * @param DocFolder              $folder  [description]
   * @param Request                $request [description]
   * @param EntityManagerInterface $manager [description]
   * @param SluggerInterface       $slugger [description]
   */
  public function add_doc_file(DocFolder $folder, Request $request, EntityManagerInterface $manager, SluggerInterface $slugger)
  {
    $file = new DocFile;
    $file ->setAuthor($this->getUser())
              ->setDocFolder($folder)
              ->setCreatedAt(new \DateTime());
    $form = $this->createForm(DocFileType::class, $file);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()){
      $pdf = $form->get('file_name')->getData();

      if ($pdf){
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
      $file->setTitle($originalFilename);
      $file->setFileName($newFilename);
      $manager->persist($file);
      $manager->flush($file);

      }
      return $this->RedirectToRoute('admin_doc_folder_show', [
        'id' => $folder->getId()
      ]);
    }
    return $this->render('dashboard/document/add_doc_file.html.twig', [
      'formDocFile' => $form->createView(),
    ]);
  }
  /**
   * @Route("/delete_doc_file/{id}", name="admin_delete_doc_file")
   * @param  DocFile $doc_file [description]
   * @return [type]                [description]
   */
  public function delete_doc_file(DocFile $file, EntityManagerInterface  $manager){
    $folder = $file->getDocFolder();
    $file_system = new Filesystem;
    $pdf = $file->getFileName();
    $file_system->remove($this->getParameter('upload_directory').'/'.$pdf);
    $manager->remove($file);
    $manager->flush($file);
    return $this->redirectToRoute('admin_doc_folder_show', [
      'id' => $folder->getId()
    ]);
  }

}
