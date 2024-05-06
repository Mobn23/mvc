<?php

namespace App\Controller;

use App\Cards\Card;
use App\Cards\CardGraphic;
use App\Cards\CardHand;
use App\Cards\Game;
use SebastianBergmann\Environment\Console;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class kmom03GameController extends AbstractController
{
    #[Route("/game/doc", name: "game_doc")]
    public function gameDoc(): Response
    {
        return $this->render('kmom03/game.doc.html.twig');
    }

    #[Route("/game", name: "game")]
    public function game(): Response
    {
        return $this->render('game/game1stside.doc.html.twig');
    }

    #[Route("game/card/draw", name: "game_card_draw", methods: ["POST"])]
    public function gameCardDraw(SessionInterface $session): Response
    {
        $game = $session->get('game');
        if (!$game instanceof Game) {
            $game = new Game();
        }

        $game->drawCard();
        $session->set('game', $game);

        // $drawnOnce = $session->get('drawn_once', false);
        // if (!$drawnOnce) {
        $session->set('drawn_once', true);
        $disableDrawButton = false;
        // } else {
        //     $session->set('drawn_once', false);
        //     $disableDrawButton = true;
        // }

        $playerPoints = $game->calculateHandValue();
        $session->set('sessionPlayerPoints', $playerPoints);

        $data = [
            "randomCard" => $game->getHandArray(),
            "playerPoints" => $playerPoints,
            "disableDrawButton" => $disableDrawButton
        ];

        if ($playerPoints > 21) {
            return $this->render('kmom03/gamecardresults21.html.twig', $data);
        }

        return $this->render('game/gamecarddeckdraw.html.twig', $data);
    }

    #[Route("game/card/stop", name: "game_card_stop", methods: ["POST"])]
    public function gameCardStop(SessionInterface $session): Response
    {
        $game = $session->get('bank');
        if (!$game instanceof Game) {
            $game = new Game();
        }
        $game->drawCard();
        $session->set('bank', $game);

        $playerPoints = $game->calculateHandValue();
        $session->set('sessionBankPoints', $playerPoints);


        if ($playerPoints > 21) {
            $session->set('bank_draw', false);
            $disableDrawButton = true;
        }

        $sessionPlayerPoints = $session->get('sessionPlayerPoints');
        $bankPoints = $session->get('sessionBankPoints');

        if ($bankPoints >= $sessionPlayerPoints) {
            $session->set('bank_draw', false);
            $disableDrawButton = true;
        } else {
            $session->set('bank_draw', true);
            $disableDrawButton = false;
        }
        // return $this->redirectToRoute('game_card_results');

        $data = [
            "randomCard" => $game->getHandArray(),
            "playerPoints" => $playerPoints,
            "disableDrawButton" => $disableDrawButton
        ];

        return $this->render('kmom03/bank.html.twig', $data);
    }

    #[Route("game/card/results", name: "game_card_results", methods: ["POST", "GET"])]
    public function gameCardSResults(SessionInterface $session): Response
    {
        $playerPoints = $session->get('sessionPlayerPoints');
        $bankPoints = $session->get('sessionBankPoints');

        if ($bankPoints >= $playerPoints || $playerPoints > 21) {
            $this->addFlash(
                'warning',
                'The Bank won!'
            );
        } elseif($bankPoints < $playerPoints || $bankPoints > 21) {
            $this->addFlash(
                'warning',
                'The Player won!'
            );
        }
        return $this->render('kmom03/results.html.twig');
    }

    #[Route("game/init", name: "game_init")]
    public function init(SessionInterface $session): Response
    {
        $session->clear();
        return $this->render('kmom03/startdrawing.html.twig');
    }
}
