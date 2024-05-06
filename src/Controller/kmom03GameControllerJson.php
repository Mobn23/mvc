<?php

namespace App\Controller;

use App\Cards\Card;
use App\Cards\CardGraphic;
use App\Cards\CardHand;
use App\Cards\Game;
use SebastianBergmann\Environment\Console;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class kmom03GameControllerJson extends AbstractController
{
    #[Route("/api/game", name: "api_game")]
    public function apiGame(SessionInterface $session): JsonResponse
    {
        $game = $session->get('game');
        if (!$game instanceof Game) {
            $game = new Game();
        }

        $responseData = [
            'player_points' => $game->calculateHandValue(),
            'bank_points' => $session->get('sessionBankPoints', 0),
        ];

        return new JsonResponse($responseData);
    }
}
