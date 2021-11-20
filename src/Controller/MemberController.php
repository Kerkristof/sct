<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use App\Repository\BlogCommentRepository;
use App\Entity\BlogComment;
use Doctrine\ORM\EntityManagerInterface;
/**
 * @Route("/member")
 */
class MemberController extends AbstractController
{
    /**
     * @Route("/index", name="member_index")
     */
    public function index(): Response
    {
      return $this->render('member/index.html.twig');
    }
    /**
     * @Route("blog/index", name="member_blog_index"): Response
     */
    public function blog_index(BlogCommentRepository $blog_repo)
    {
      $blog_comments = $blog_repo->findBy([], ['createdAt' => 'DESC']);
      return $this->render('member/blog_index.html.twig', [
        'blog_comments' => $blog_comments
      ]);
    }
    /**
     * @Route("blog/post", name="member_blog_post")
     * @param  BlogComment            $BlogComment   [description]
     * @param  Request                $request       [description]
     * @param  EntityManagerInterface $entityManager [description]
     * @return [type]                                [description]
     */
    public function blog_post(Request $request, EntityManagerInterface $entityManager)
    {
      $blog_comment = new BlogComment();
      $blog_comment ->setAuthor($this->getUser())
                    ->setCreatedAt(new \DateTime())
                    ->setContent($request->request->get('content'));

      $entityManager->persist($blog_comment);
      $entityManager->flush();
      return $this->redirectToRoute('member_blog_index');
    }
    /**
     * @Route("/blog/delete/{id}", name="member_blog_delete")
     * @param  BlogComment   $blog_comment [description]
     * @param  ObjectManager $manager      [description]
     * @return [type]                      [description]
     */
    public function delete(BlogComment $blog_comment, EntityManagerInterface $entityManager)
    {
      $entityManager->remove($blog_comment);
      $entityManager->flush();
      return $this->RedirectToRoute('member_blog_index');

    }
}
