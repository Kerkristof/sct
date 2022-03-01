<?php

namespace App\Controller\dashboard;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\StatisticRepository;


/**
 * @Route("/admin")
 */
class DashboardController extends AbstractController
{
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function index(StatisticRepository $stat_repo): Response
    {
        $statistic = $stat_repo->findAll();
        return $this->render('dashboard/base.html.twig', [
            'controller_name' => 'DashboardController',
            'logs' => sizeof($statistic)
        ]);
    }
}
