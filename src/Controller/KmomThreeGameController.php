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

class KmomThreeGameController extends AbstractController
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
        $playerRandomCard = $game->getHandArray();
        $session->set('sessionPlayerRandomCard', $playerRandomCard);
        $session->set('sessionDisableDrawButton', $disableDrawButton);

        $turn = "Players's turn";
        $data = [
            "playerRandomCard" => $playerRandomCard,
            "playerPoints" => $playerPoints,
            "disableDrawButton" => $disableDrawButton,
            "turn" => $turn,
            "playerTurn" => true,
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
        $continueDrawing = true;
        while ($continueDrawing) {
            $game->drawCard();
            $session->set('bank', $game);

            $bankPoints = $game->calculateHandValue();
            $session->set('sessionBankPoints', $bankPoints);

            if ($bankPoints > 21) {
                $session->set('bank_draw', false);
                // $disableDrawButton = true;
            }

            $sessionPlayerPoints = $session->get('sessionPlayerPoints');
            if ($bankPoints >= $sessionPlayerPoints || $bankPoints > 21) {
                // $session->set('bank_draw', false);
                $continueDrawing = false;
                // $disableDrawButton = true;
            }
            $session->set('bank_draw', true);
            // $disableDrawButton = false;
            // return $this->redirectToRoute('game_card_results');
        }
        dump($session->all());

        $bankRandomCard = $game->getHandArray();
        $session->set('sessionRandomCard', $bankRandomCard);
        $playerRandomCard = $session->get('sessionPlayerRandomCard');
        $turn = "Bank's turn";
        $data = [
            "bankRandomCard" => $bankRandomCard,
            "bankPoints" => $bankPoints,
            "continueDrawing" => $continueDrawing,
            "playerRandomCard" => $playerRandomCard,
            "playerPoints" => $sessionPlayerPoints,
            "turn" => $turn,
            "playerTurn" => false,
            // "disableDrawButton" => $disableDrawButton
        ];

        return $this->render('game/gamecarddeckdraw.html.twig', $data);
    }

    #[Route("game/card/results", name: "game_card_results", methods: ["POST", "GET"])]
    public function gameCardSResults(SessionInterface $session): Response
    {
        $playerPoints = $session->get('sessionPlayerPoints');
        $bankPoints = $session->get('sessionBankPoints');

        if ($bankPoints >= $playerPoints && $bankPoints <= 21 || $playerPoints > 21) {
            $this->addFlash(
                'warning',
                'The Bank won!'
            );
        } elseif($bankPoints < $playerPoints || $bankPoints > 21) {
            dump('bankPoints: ' . $bankPoints);
            $this->addFlash(
                'warning',
                'The Player won!'
            );
        }
        return $this->render('kmom03/results.html.twig');
    }
}
// $game = $session->get('game', new Game());
// $playerPoints = $session->get('sessionPlayerPoints', 0);
// $bankPoints = $session->get('sessionBankPoints', 0);
// $disableDrawButton = $session->get('disableDrawButton', false);

// $randomCard = $session->get('sessionRandomCard', 0);

// $data = [
//     'randomCard' => $randomCard,
//     'playerPoints' => $playerPoints,
//     'bankPoints' => $bankPoints,
//     'disableDrawButton' => $disableDrawButton,
// ];
