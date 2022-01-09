<?php

namespace App\Controller\dashboard;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ContactMessageRepository;
use App\Entity\ContactMessage;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @Route("/admin")
 */
class ContactMessageCrudController extends AbstractController
{
    /**
     * @Route("/contact/message/index", name="admin_contact_message_index")
     */
    public function index(ContactMessageRepository $contact_message_repo): Response
    {
        $contact_messages = $contact_message_repo->findBy([], ['created_at' => 'DESC']);
        return $this->render('dashboard/contact_message/index.html.twig', [
            'contact_messages' => $contact_messages,
        ]);
    }

    /**
     * @Route("/contact/message/delete/{id}", name="admin_contact_message_delete")
     * @param  ContactMessage         $contact_message [description]
     * @param  EntityManagerInterface $manager         [description]
     * @return Response                                [description]
     */
    public function delete(ContactMessage $contact_message, EntityManagerInterface $manager): Response
    {
      $manager->remove($contact_message);
      $manager->flush($contact_message);
      return $this->redirectToRoute('admin_contact_message_index');
    }
}
