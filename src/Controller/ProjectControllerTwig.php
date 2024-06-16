<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProjectControllerTwig extends AbstractController
{
    #[Route("/proj/about", name: "proj_about")]
    public function gameDoc(): Response
    {
        return $this->render('project/about.html.twig');
    }

    #[Route("/proj", name: "proj")]
    public function proj(): Response
    {
        return $this->render('project/projectmainpage.html.twig');
    }

    #[Route("/init", name: "proj_game_init")]
    public function initialize(Request $request): Response
    {
        $numPlayers = $request->request->get('num_players');
        return $this->redirectToRoute('players_names', ['numPlayers' => $numPlayers]);
    }

    #[Route("/names/{numPlayers}", name: "players_names")]
    public function names(int $numPlayers): Response
    {
        return $this->render('project/players.names.html.twig', ['numPlayers' => $numPlayers]);
    }
}
