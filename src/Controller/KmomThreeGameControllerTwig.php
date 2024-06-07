<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class KmomThreeGameControllerTwig extends AbstractController
{
    #[Route("/game/doc", name: "game_doc")]
    public function gameDoc(): Response
    {
        return $this->render('kmom03/game.doc.html.twig');
    }

    #[Route("/game", name: "game_intro")]
    public function game(): Response
    {
        return $this->render('game/game1stside.doc.html.twig');
    }

    #[Route("game/init", name: "game_init")]
    public function init(SessionInterface $session): Response
    {
        $session->clear();
        return $this->render('kmom03/startdrawing.html.twig');
    }

        #[Route("game/card/results", name: "game_card_results", methods: ["POST", "GET"])]
    public function gameCardSResults(SessionInterface $session): Response
    {
        $playerPoints = $session->get('sessionPlayerPoints');
        $bankPoints = $session->get('sessionBankPoints');

        if (($bankPoints >= $playerPoints && $bankPoints <= 21) || $playerPoints > 21) {
            $this->addFlash(
                'warning',
                'The Bank won!'
            );
        } elseif($bankPoints < $playerPoints || $bankPoints > 21) {
            // dump('bankPoints: ' . $bankPoints);
            $this->addFlash(
                'warning',
                'The Player won!'
            );
        }
        return $this->render('kmom03/results.html.twig');
    }
}
