<?php

namespace App\Controller\dashboard;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ArticleRepository;
use App\Entity\Article;
use App\Form\ArticleType;
use App\Entity\Paragraph;
use App\Repository\ParagraphRepository;
use App\Form\ParagraphType;
use App\Entity\ParagraphImage;
use App\Form\ParagraphImageType;
use App\Repository\ParagraphImageRepository;

/**
 * @Route("/admin")
 */
class ArticleCrudController extends AbstractController
{
    /**
     * @Route("/article/index", name="admin_article_index")
     */
    public function index(ArticleRepository $repo): Response
    {
      $articles = $repo->findAll();
        return $this->render('dashboard/article/index.html.twig', [
            'articles' => $articles,
        ]);
    }

    /**
     * @Route("/article/create", name="admin_article_create")
     * @Route("/article/update/{id}", name="admin_article_update")
     * @param  [type]                 $article [description]
     * @param  Request                $request [description]
     * @param  EntityManagerInterface $manager [description]
     * @return [type]                          [description]
     */
    public function article_create(Article $article = null, Request $request, EntityManagerInterface $manager)
    {
      if (!$article) {
        $article = new Article;
        $article->setAuthor($this->getUser())// dd($article);
                ->setCreatedAt(new \DateTime());
      }
      $form = $this->createForm(ArticleType::class, $article);
      $form->handleRequest($request);
      if ($form->isSubmitted() && $form-> isValid()) {
        $manager->persist($article);
        $manager->flush($article);
        return $this->RedirectToRoute('admin_article_index');
      }
      return $this->render('dashboard/article/article_edit.html.twig', [
        'formArticle' => $form->createView(),
        'editMode' => $article->getId() != null
      ]);
    }

    /**
     * @Route("/article/delete/{id}", name= "admin_article_delete")
     * @param  Article                $article [description]
     * @param  EntityManagerInterface $manager [description]
     * @return [type]                          [description]
     */
    public function article_delete(Article $article, EntityManagerInterface $manager)
    {
      $manager->remove($article);
      $manager->flush($article);
      return $this->RedirectToRoute('admin_article_index');
    }

    /**
     * @Route("/article/show/{id}", name="admin_article_show")
     * @param  Article $article [description]
     * @return [type]           [description]
     */
    public function article_show(Article $article)
    {
      return $this->render('dashboard/article/article_show.html.twig', [
        'article' => $article
      ]);
    }

      /**
      * @Route("/paragraph/create/{article_id}", name="admin_paragraph_create")
      * @Route("/paragraph/update/{id}/{article_id}", name="admin_paragraph_update")
      * @param  [type]                 $paragraph  [description]
      * @param  [type]                 $article_id [description]
      * @param  Request                $request    [description]
      * @param  EntityManagerInterface $manager    [description]
      * @param  ArticleRepository      $repo       [description]
      * @return [type]                             [description]
      */
    public function paragraph_create(Paragraph $paragraph = null, $article_id, Request $request, ArticleRepository $repo,
    EntityManagerInterface $manager )
    {
      $article = $repo->findOneBy(['id' => $article_id]);
      if (!$paragraph) {
        $paragraph = new Paragraph;
        $paragraph->setArticle($article);
      }
      $form = $this->createForm(ParagraphType::class, $paragraph);
      $form->handleRequest($request);
      if ($form->isSubmitted() && $form-> isValid()) {
        $manager->persist($paragraph);
        $manager->flush($paragraph);
        return $this->RedirectToRoute('admin_article_show', [
          'id' => $article_id
        ]);
      }
      return $this->render('dashboard/article/paragraph_edit.html.twig', [
        'formParagraph' => $form->createView(),
        'editMode' => $paragraph->getId() != null
      ]);
    }

    /**
     * @Route("/paragraph/delete/{id}/{article_id}", name="admin_paragraph_delete")
     * @param  Article                $article   [description]
     * @param  Paragraph              $paragraph [description]
     * @param  EntityManagerInterface $manager   [description]
     * @return [type]                            [description]
     */
    public function paragraph_delete(Paragraph $paragraph, $article_id, EntityManagerInterface $manager)
    {
      $manager->remove($paragraph);
      $manager->flush($paragraph);
      return $this->RedirectToRoute('admin_article_show' , [
        'id' => $article_id
        ] );
    }
    /**
     * @Route("/paragraph/image/add/{id}/{article_id}", name="admin_paragraph_image_add")
     * @param Paragraph $paragraph  [description]
     * @param [type]    $article_id [description]
     */
    public function paragraph_add_image(Paragraph $paragraph, $article_id, Request $request, EntityManagerInterface $manager )
    {
      $paragraph_image = new ParagraphImage;
      $paragraph_image->setParagrah($paragraph);
      $form = $this->createForm(ParagraphImageType::class, $paragraph_image);
      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()) {
        // dd($paragraph_image);
        $manager->persist($paragraph_image);
        $manager->flush($paragraph);
        return $this->RedirectToRoute('admin_article_show' , [
          'id' => $article_id
        ]);
      }
      return $this->render('dashboard/article/paragraph_image_edit.html.twig', [
        'formParagraphImage' => $form->createView(),
      ]);
    }

    /**
    * @Route("/paragraph/image/delete/{paragraph_image_id}/{article_id}", name="admin_paragraph_image_delete")
    * @param  [type]                   $paragraph_image_id [description]
    * @param  [type]                   $article_id         [description]
    * @param  EntityManagerInterface   $manager            [description]
    * @param  ParagraphImageRepository $repo               [description]
    * @return [type]                                       [description]
    */
    public function paragraph_image_delete($paragraph_image_id, $article_id, EntityManagerInterface $manager, ParagraphImageRepository $repo)
    {
      $paragraph_image = $repo->findOneBy(['id' => $paragraph_image_id]);
      $manager->remove($paragraph_image);
      $manager->flush($paragraph_image);
      return $this->redirectToRoute('admin_article_show', [
        'id' => $article_id
      ]);
    }
}
