<?php
namespace App\Controller\dashboard;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CompetitionRepository;
use App\Form\CompetitionType;
use App\Entity\Competition;
use App\Entity\Team;
use App\Entity\Competitor;
use App\Form\CompetitorType;

/**
 * @Route("/admin")
 */
class CompetitionCrudController extends AbstractController
{
    /**
     * @Route("/competition/index", name="admin_competition_index")
     */
    public function index(CompetitionRepository $repo): Response
    {
        $competitions = $repo->findAll();
        return $this->render('dashboard/competition/index.html.twig', [
            'competitions' => $competitions
        ]);
    }
    /**
     * @Route("/competition/create", name="admin_competition_create")
     * @Route("/competition/update/{id}", name="admin_competition_update")
     * @return Response [description]
     */
    public function create(Competition $competition = null, Request $request, EntityManagerInterface $manager): Response
    {
      if (!$competition){
        $competition = new Competition;
      }
      $form = $this->createForm(CompetitionType::class, $competition);
      $form->handleRequest($request);
      if ($form->isSubmitted() && $form-> isValid()) {
        $manager->persist($competition);
        $manager->flush($competition);
        return $this->RedirectToRoute('admin_competition_index');
      }
      return $this->render('dashboard/competition/competition_edit.html.twig', [
        'formCompetition' => $form->createView(),
        'editMode' => $competition->getId() != null
      ]);
    }
    /**
     * @Route("/competition/show/{id}", name="admin_competition_show")
     * @param  Competition $competition [description]
     * @return Response                 [description]
     */
    public function competition_show(Competition $competition): Response
    {
      return $this->render('dashboard/competition/competition_show.html.twig', [
        "competition" => $competition
      ]);
    }
    /**
     * @Route("/competition/delete/{id}", name="admin_competition_delete")
     * @param  Competition            $competition [description]
     * @param  EntityManagerInterface $manager     [description]
     * @return Response                            [description]
     */
    public function competition_delete(Competition $competition, EntityManagerInterface $manager) : Response
    {
      $manager->remove($competition);
      $manager->flush();
      return $this->RedirectToRoute('admin_competition_index');
    }
    /**
     * @Route("/team/delete/{id}", name="admin_team_delete")
     * @param  Team                   $team_id [description]
     * @param  EntityManagerInterface $manager [description]
     * @return Response                        [description]
     */
    public function team_delete(Team $team, EntityManagerInterface $manager): Response
    {
      $manager->remove($team);
      $manager->flush();
      return $this->RedirectToRoute('admin_competition_show', ['id' => $team->getCompetition()->getId()]);
    }
    /**
     * @Route("/team/show/{id}", name="admin_team_show")
     * @param  Team     $team [description]
     * @return Response       [description]
     */
    public function team_show(Team $team): Response
    {
      return $this->render('dashboard/competition/team_show.html.twig', [
        'team' => $team
      ]);
    }
    /**
     * @Route("/team/validation/{id}", name="admin_team_validation")
     * @param  Team     $team [description]
     * @return Response       [description]
     */
    public function team_validation(Team $team, EntityManagerInterface $manager):Response
    {
      $team->setActive(true);
      $manager->persist($team);
      $manager->flush();
      return $this->RedirectToRoute('admin_competition_show', ['id' => $team->getCompetition()->getId()]);
    }

    /**
     * @Route("/competitor/update/{id}", name="admin_competitor_update")
     * @return Response [description]
     */
    public function competitor_create(Competitor $competitor, EntityManagerInterface $manager, Request $request ) :Response
    {
      $form = $this->createForm(CompetitorType::class, $competitor);
      $form->handleRequest($request);
      if ($form->isSubmitted() && $form-> isValid())
      {
        $manager->persist($competitor);
        $manager->flush($competitor);
        return $this->RedirectToRoute('admin_team_show', [
          'id' => $competitor->getTeam()->getId()
        ]);
      }
      return $this->render('competition/competitor_edit.html.twig', [
        'competition' => $competitor->getTeam()->getCompetition(),
        'registred' => null,
        'formCompetitor' => $form->createView(),
        'editMode' => $competitor-> getId() != null
      ]);
    }
}
