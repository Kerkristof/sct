<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
}
