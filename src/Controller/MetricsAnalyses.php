<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MetricsAnalyses extends AbstractController
{
    #[Route("/metrics", name: "metrics_page")]
    public function gameDoc(): Response
    {
        return $this->render('analyses/metrics.html.twig');
    }
}
