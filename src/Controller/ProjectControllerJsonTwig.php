<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjectControllerJsonTwig extends AbstractController
{
    #[Route("/proj/api", name: "proj_api")]
    public function gameDoc(): Response
    {
        return $this->render('project/api.html.twig');
    }
}
