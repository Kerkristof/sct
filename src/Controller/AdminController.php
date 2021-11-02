<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;


/**
 * @Route("/admin")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/index", name="admin_index")
     */
    public function index(UserRepository $user_repo): Response
    {
        $users = $user_repo->findBy([], ['roles' => 'DESC']);
        return $this->render('admin/index.html.twig', [
          'users' => $users,
          ]) ;
    }

    /**
     * [update_role description]
     * @Route("/update/{id}", name="admin_update_user")
     * @param  User    $user    [description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function update_role(User $user ,Request $request)
    {
      if ($user->getEmail() != "kerkristof@gmail.com") {
        $user_role = $request->request->get('role');
        $user->setRoles([$user_role]);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();
        $this->addFlash('success', 'Le compte '.$user->getEmail().' a bien été modifié!');
      }
      else {
        $this->addFlash('protected_user', 'Vous ne pouvez pas modifier cet utilisateur');
      }
      return $this->redirectToRoute('admin_index');
    }

    /**
     * @Route("/delete/{id}", name="admin_delete_user")
     * @param  User  $user [description]
     * @return [type]       [description]
     */
    public function delete_user(User $user, EntityManagerInterface $entityManager)
    {
      if ($user->getEmail() != "kerkristof@gmail.com") {
        $entityManager->remove($user);
        $entityManager->flush($user);
        $this->addFlash('success', 'Le compte '.$user->getEmail().' a bien été supprimé!');
      }
      else {
        $this->addFlash('protected_user', 'Vous ne pouvez pas supprimer cet utilisateur');
      }
      return $this->redirectToRoute('admin_index');
    }
}
