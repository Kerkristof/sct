<?php

namespace App\Controller\dashboard;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\GaleryPictureRepository;
use App\Entity\GaleryPicture;
use App\Form\GaleryPictureType;

/**
 * @Route("/admin")
 */
class GaleryPictureCrudController extends AbstractController
{
    /**
     * @Route("/galery/index", name="admin_galery_index")
     */
    public function index(GaleryPictureRepository $picture_repo): Response
    {
      $pictures = $picture_repo->findAll();
      return $this->render('dashboard/galery/index.html.twig', [
          'pictures' => $pictures
      ]);
    }

    /**
     * @Route("/galery/create", name="admin_galery_create")
     * @Route("galery/update/{id}", name="admin_galery_update")
     * @param  Request                $request        [description]
     * @param  EntityManagerInterface $manager        [description]
     * @return Response                               [description]
     */
    public function create(GaleryPicture $galery_picture = null, Request $request, EntityManagerInterface $manager): Response
    {
      if(!$galery_picture){
        $galery_picture = new GaleryPicture();
      }
      $form = $this->createForm(GaleryPictureType::class, $galery_picture);
      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid())
      {
        $manager->persist($galery_picture);
        $manager->flush($galery_picture);
        return $this->RedirectToRoute('admin_galery_index');

      }
      return $this->render('dashboard/galery/edit.html.twig', [
        'formGalery' => $form->createView(),
        'editMode' => $galery_picture->getId() != null
      ]);
    }

    /**
     * @Route("/galery/delete/{id}", name="admin_galery_delete")
     * @param  GaleryPicture            $galery_picture [description]
     * @param  EntityManagerInterfacety $manager        [description]
     * @return Response                                 [description]
     */
    public function delete(GaleryPicture $galery_picture, EntityManagerInterface $manager): Response
    {
      $manager->remove($galery_picture);
      $manager->flush($galery_picture);
      return $this->RedirectToRoute('admin_galery_index');
    }
}
