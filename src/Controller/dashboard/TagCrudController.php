<?php

namespace App\Controller\dashboard;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Tag;
use App\Form\TagType;
use App\Repository\TagRepository;

/**
 * @Route("admin")
 */
class TagCrudController extends AbstractController
{
    /**
     * @Route("/index", name="admin_tag_index")
     */
    public function index(TagRepository $repo): Response
    {
        $tags = $repo->findAll();
        return $this->render('dashboard/tag/index.html.twig', [
            'tags' => $tags
        ]);
    }

    /**
    * @Route("/tag/create", name="admin_tag_create")
    * @Route("/tag/update/{id}", name="admin_tag_update")
     * @param  [type]                 $tag     [description]
     * @param  Request                $request [description]
     * @param  EntityManagerInterface $manager [description]
     * @return Response                        [description]
     */
    public function create(Tag $tag=null, Request $request, EntityManagerInterface $manager): Response
    {
      if (!$tag) {
        $tag = new Tag;
      }
      $form = $this->createForm(TagType::class, $tag);
      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()) {
        $manager->persist($tag);
        $manager->flush($tag);
        return $this->RedirectToRoute('admin_tag_index');
      }
      return $this->render('dashboard/tag/edit.html.twig', [
        'formTag' => $form->createView(),
        'editMode' => $tag->getId() !=null
      ]);
    }

    /**
     * @Route("/tag/delete/{id}", name="admin_tag_delete")
     * @param  Tag                    $tag     [description]
     * @param  EntityManagerInterface $manager [description]
     * @return Response                        [description]
     */
    public function delete(Tag $tag, EntityManagerInterface $manager): Response
    {
      $manager->remove($tag);
      $manager->flush($tag);
      return $this->RedirectToRoute('admin_tag_index');
    }
}
