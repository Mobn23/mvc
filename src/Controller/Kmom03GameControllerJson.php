<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class Kmom03GameControllerJson extends AbstractController
{
    #[Route("/api/game", name: "api_game")]
    public function apiGame(SessionInterface $session): JsonResponse
    {
        $responseData = [
            'player_points' => $session->get('sessionPlayerPoints', 0),
            'bank_points' => $session->get('sessionBankPoints', 0),
        ];

        return new JsonResponse($responseData);
    }
}
