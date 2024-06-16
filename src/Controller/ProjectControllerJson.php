<?php

namespace App\Controller;

use App\Cards\Game;
use App\Cards\Player;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProjectControllerJson extends AbstractController
{
    #[Route("/api/game/state", name: "api_game_state", methods: ["GET"])]
    public function apiGameState(SessionInterface $session): JsonResponse
    {
        $gameState = $session->get('gameState', []);
        $dealer = $session->get('dealer', []);

        $session->clear();
        return $this->json([
            'players' => $gameState,
            'dealer' => $dealer,
        ]);
    }

    #[Route("api/hit", name: "api_hit")]
    public function apiHit(): Response
    {
        $game = new Game();
        $playerHand[] = $game->drawCard();;
        $handPoints = $game->calculateHandValue();

        return $this->json([
            'playerHand' => $playerHand,
            'handPoints' => $handPoints,
        ]);
    }

    #[Route("/api/start/game", name: "api_start_game", methods: ["POST"])]
    public function startGameApi(Request $request): JsonResponse
    {
        $playerName = $request->request->get('api_name');
        $playerBet = $request->request->get('api_bet');

        $game = new Game();
        $game->drawCard();
        $game->drawCard();
        $hand = $game->getHandArray();
        $handPoints = $game->calculateHandValue();

        $data = [
            'message' => 'Game started successfully',
            'playerName' => $playerName,
            'playerBet' => $playerBet,
            "hand" => $hand,
            "handPoints" => $handPoints,
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
            // | combines or merges
        );
        return $response;
    }

    #[Route("/api/dealer/turn", name: "api_dealer_turn", methods: ["POST", "GET"])]
    public function apiDealerTurn(): JsonResponse
    {
        $dealerGame = new Game();
        $dealerGame->drawCard();
        $dealerHandPoints = $dealerGame->calculateHandValue();

        while ($dealerHandPoints < 17) {
            $dealerGame->drawCard();
            $dealerHandPoints = $dealerGame->calculateHandValue();
        }

        $dealerHand = $dealerGame->getHandArray();

        $data = [
            "dealerhand" => $dealerHand,
            "dealerhandPoints" => $dealerHandPoints,
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
            // | combines or merges
        );
        return $response;
    }

    #[Route("/api/create/player", name: "api_create_player", methods: ['POST'])]
    public function checkNamesBets(Request $request): Response
    {
        $playerName = $request->get('test_names');
        $playerBet = $request->get('test_bets');

        $player = new Player($playerName, $playerBet);
        $playerName = $player->getName();
        $playerBet = $player->getBet();
        $data = [
            "player" => $player->toArray()
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
            // | combines or merges
        );
        return $response;
    }
}
