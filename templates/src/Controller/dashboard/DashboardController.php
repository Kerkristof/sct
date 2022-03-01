<?php

namespace App\Controller\dashboard;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/admin")
 */
class DashboardController extends AbstractController
{
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function index(): Response
    {
        return $this->render('dashboard/base.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }
}
