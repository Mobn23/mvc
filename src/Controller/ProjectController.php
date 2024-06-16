<?php

namespace App\Controller;

use App\Cards\Player;
use App\Cards\Game;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProjectController extends AbstractController
{
    // #[Route("/handle/names", name: "handle_names", methods: ['POST'])]
    // public function handleNames(Request $request): Response
    // {
    //     $formData = $request->request->all();
    //     $formDataDump = print_r($formData, true);
    //     dump($formData);
    
    //     if (isset($formData['playerData'])) {
    //         $playerDataJson = $formData['playerData'];
    //         dump($playerDataJson);
    //         $playerData = json_decode($playerDataJson, true);

    //         return $this->render('project/black.jack.html.twig', [
    //             'formDataDump' => $formDataDump,
    //             'playerDataDump' => json_encode($playerData)
    //         ]);
    //     } else {
    //         return $this->render('project/black.jack.html.twig', [
    //             'formDataDump' => $formDataDump,
    //             'playerDataDump' => null
    //         ]);
    //     }
    // }

    #[Route("/start/game", name: "start_game", methods: ['POST'])]
    public function startGame(Request $request, SessionInterface $session): Response
    {
        $formData = $request->request->all();
        $playerDataJson = $formData['playerData'] ?? '[]';
        $playersData = json_decode($playerDataJson, true);

        $gameState = [];
        foreach ($playersData as $playerData) {
            $playerName = $playerData['name'];
            $playerBet = $playerData['bet'];

            $game = new Game();
            $game->drawCard();
            $game->drawCard();
            $hand = $game->getHandArray();
            $handPoints = $game->calculateHandValue();

            $player = new Player($playerName, $playerBet);
            // dump($player);

            $bet = $player->getBet();
            $isBlackjack = false;
            if($handPoints === 21) {
                $bet = $bet * 1.5;
                $isBlackjack = true;
            }

            $gameState[] = [
                "name" => $player->getName(),
                "bet" => $bet,
                "hand" => $hand,
                "stayed" => false,
                "busted" => false,
                "handPoints" => $handPoints,
                "game" => $game,
                'done' => $isBlackjack,
                'blackjack' => $isBlackjack
            ];
        }

        $dealerGame = new Game();
        $dealerGame->drawCard();
        $dealerHand = $dealerGame->getHandArray();

        $dealer = [
            "name" => "Dealer",
            "hand" => $dealerHand,
            "bet" => 0,
            "game" => $dealerGame,
            "handPoints" => $dealerGame->calculateHandValue()
        ];

        $data = [
            'gameState' => $gameState,
            'dealer' => $dealer,
        ];

        foreach ($gameState as $player) {
            if ($player['handPoints'] > 21) {
                $player['done'] = true;
                $player['busted'] = true;
            }
        }

        // dump($gameState);
        $session->set('gameState', $gameState);
        $session->set('dealer', $dealer);

        return $this->render('project/black.jack.html.twig', $data);
    }

    #[Route("/hit/{playerName}", name: "hit", methods: ['POST'])]
    public function hit(SessionInterface $session, string $playerName): Response
    {
        $gameState = $session->get('gameState', []);
        $dealer = $session->get('dealer', []);

        foreach ($gameState as &$player) {
            if ($player['name'] === $playerName && !$player['stayed']) {
                $game = $player['game'];
                $player['hand'][] = $game->drawCard();;
                $player['handPoints'] = $game->calculateHandValue();

                if ($player['handPoints'] > 21) {
                    $dealer['bet'] += $player['bet'];
                    $player['bet'] = 0;
                    $player['busted'] = true;
                    $player['done'] = true;
                } elseif ($player['handPoints'] === 21) {
                    $player['done'] = true;
                }
            }
        }

        if ($this->areAllPlayersDone($gameState)) {
            $this->dealerTurn($gameState, $dealer);
        }

        $session->set('gameState', $gameState);
        $session->set('dealer', $dealer);

        $data = [
            'gameState' => $gameState,
            'dealer' => $dealer,
        ];

        return $this->render('project/black.jack.html.twig', $data);
    }

    #[Route("/stay/{playerName}", name: "stay", methods: ['POST'])]
    public function stay(SessionInterface $session, string $playerName): Response
    {
        $gameState = $session->get('gameState', []);
        $dealer = $session->get('dealer', []);

        foreach ($gameState as &$player) {
            if ($player['name'] === $playerName) {
                $player['stayed'] = true;
                $player['done'] = true;
                break;
            }
        }

        if ($this->areAllPlayersDone($gameState)) {
            $this->dealerTurn($gameState, $dealer);
        }

        $session->set('gameState', $gameState);
        $session->set('dealer', $dealer);

        $data = [
            'gameState' => $gameState,
            'dealer' => $dealer,
        ];

        return $this->render('project/black.jack.html.twig', $data);
    }

    private function areAllPlayersDone(array $gameState): bool
    {
        foreach ($gameState as $player) {
            if (!$player['done']) {
                return false;
            }
        }
        return true;
    }

    private function dealerTurn(array &$gameState, array &$dealer)
    {
        $dealerGame = $dealer['game'];
        $dealerHandPoints = $dealer['handPoints'];

        while ($dealerHandPoints < 17) {
            $dealerGame->drawCard();
            $dealerHandPoints = $dealerGame->calculateHandValue();
        }

        $dealer['hand'] = $dealerGame->getHandArray();
        $dealer['handPoints'] = $dealerHandPoints;

        foreach ($gameState as &$player) {
            if (!$player['busted']) {
                if ($dealerHandPoints > 21 || $player['handPoints'] > $dealerHandPoints) {
                    $player['bet'] *= 2;
                } else if ($player['handPoints'] < $dealerHandPoints) {
                    $dealer['bet'] += $player['bet'];
                    $player['bet'] = 0;
                }
            }
        }
    }
}
