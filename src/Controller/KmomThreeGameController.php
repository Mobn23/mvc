<?php

namespace App\Controller;

use App\Cards\Game;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class KmomThreeGameController extends AbstractController
{
    #[Route("game/card/draw", name: "game_card_draw", methods: ["POST"])]
    public function gameCardDraw(SessionInterface $session): Response
    {
        $game = $session->get('game', new Game());

        $game->drawCard();
        $session->set('game', $game);

        $session->set('drawn_once', true);
        $disableDrawButton = false;

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
        $game = $session->get('bank', new Game());
        $continueDrawing = true;

        $bankPoints = 0;
        $sessionPlayerPoints = $session->get('sessionPlayerPoints', 0);
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
        // dump($session->all());

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
}
