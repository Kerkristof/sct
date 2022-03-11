<?php

namespace App\Controller\dashboard;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\SponsorRepository;
use App\Form\SponsorType;
use App\Entity\Sponsor;

/**
 * @Route("/admin")
 */
class SponsorCrudController extends AbstractController
{
    /**
     * @Route("/sponsor/index", name="admin_sponsor_index")
     */
    public function index(SponsorRepository $repo): Response
    {
        $sponsors = $repo->findAll();
        return $this->render('dashboard/sponsor/index.html.twig', [
            'sponsors' => $sponsors
        ]);
    }

    /**
     * @Route("/sponsor/create", name="admin_sponsor_create")
     * @Route("/sponsor/update/{id}", name="admin_sponsor_update")
     * @param  [type]                 $sponsor [description]
     * @param  Request                $request [description]
     * @param  EntityManagerInterface $manager [description]
     * @return [type]                          [description]
     */
    public function create(Sponsor $sponsor = null, Request $request, EntityManagerInterface $manager)
    {
      if(!$sponsor){
        $sponsor = new Sponsor;
      }
      $form = $this->createForm(SponsorType::class, $sponsor);
      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid())
      {
        $manager->persist($sponsor);
        $manager->flush($sponsor);
        return $this->RedirectToRoute('admin_sponsor_index');
      }
      return $this->render('dashboard/sponsor/edit.html.twig', [
        'formSponsor' => $form->createView(),
        'editMode' => $sponsor->getId() != null
      ]);
    }
    
    /**
     * @Route("/sponsor/delete/{id}", name="admin_sponsor_delete")
     * @param  Sponsor                $sponsor [description]
     * @param  EntityManagerInterface $manager [description]
     * @return [type]                          [description]
     */
    public function delete(Sponsor $sponsor, EntityManagerInterface $manager)
    {
      $manager->remove($sponsor);
      $manager->flush($sponsor);
      return $this->redirectToRoute('admin_sponsor_index');
    }
}
