<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Competition;
use App\Repository\CompetitionRepository;
use App\Entity\Team;
use App\Form\TeamType;
use App\Repository\TeamRepository;
use App\Entity\Competitor;
use App\Form\CompetitorType;

class CompetitionController extends AbstractController
{
    /**
     * @Route("/competition/index", name="competition_index")
     */
    public function index(CompetitionRepository $repo): Response
    {
      $active_competitions = $repo->findBy(['active'=>true]);

        return $this->render('competition/index.html.twig', [
            'active_competitions' => $active_competitions
        ]);
    }

    /**
     * @Route("/competitor/create/{id}/{team_id}/{registred}", name="competitor_create")
     * @param  Competition            $competition [description]
     * @param  [type]                 $team_id     [description]
     * @param  integer                $registred   [description]
     * @param  Request                $request     [description]
     * @param  EntityManagerInterface $manager     [description]
     * @param  TeamRepository         $repo        [description]
     * @return Response                            [description]
     */
    public function competitor_create(Competition $competition, $team_id = null, $registred = 0 , Request $request, EntityManagerInterface $manager, TeamRepository $team_repo):Response
    {
      $competitor = new Competitor;
      $form = $this->createForm(CompetitorType::class, $competitor);
      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid())
      {
        if ($registred < 1) {
          $team = new Team;
          $team ->setActive(false)
          ->setCompetition($competition)
          ->setCreatedAt(new \DateTime());
          $manager->persist($team);
          $manager->flush($team);
        }
        else
        {
          $team = $team_repo->findOneBy(['id' => $team_id]);
        }
        $registred += 1;
        $competitor->setTeam($team);
        $manager->persist($competitor);
        $manager->flush($competitor);
        if ($registred < $competition->getTeamSize())
        {
          return $this->RedirectToRoute("competitor_create", [
            'id' => $competition->getId(),
            'team_id' => $team->getId(),
            'registred' => $registred
          ]);
        }
        else
        {
          return $this->RedirectToRoute('competition_index');
        }
      }
      return $this->render('/competition/competitor_edit.html.twig', [
        'formCompetitor' => $form->createView(),
        'competition' => $competition,
        'registred' => $registred,
        'editMode' => $competitor->getId() != null
      ]);
    }
}
