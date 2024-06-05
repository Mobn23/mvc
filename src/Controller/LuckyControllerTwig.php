<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LuckyControllerTwig extends AbstractController
{
    #[Route("/lucky", name: "lucky")]
    public function lucky(): Response
    {
        $number = random_int(0, 100);
        $videoPath = 'videos/crazy-video.mp4';

        $data = [
            'number' => $number,
            'videoPath' => $videoPath
        ];

        return $this->render('lucky.html.twig', $data);
    }

    #[Route("/", name: "me")]
    public function meMethod(): Response
    {
        return $this->render('me.html.twig');
    }

    #[Route("/about", name: "about")]
    public function about(): Response
    {
        return $this->render('about.html.twig');
    }

    #[Route("/report", name: "report")]
    public function report(): Response
    {
        return $this->render('report.html.twig');
    }

    #[Route("/api", name: "api")]
    public function apiSummary(): Response
    {
        return $this->render('api.html.twig');
    }

    #[Route("/game", name: "game")]
    public function game(): Response
    {
        return $this->render('kmom03/game.html.twig');
    }
}
