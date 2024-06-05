<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * This class for hi and random number.
 */
class LuckyController
{
    /**
     * Renders random num between 0, 100.
     */
    #[Route('/lucky/number')]
    public function number(): Response
    {
        $number = random_int(0, 100);

        return new Response(
            '<html><body>Lucky number: '.$number.'</body></html>'
        );
    }

    /**
     * Renders Hi to you!.
     */
    #[Route("/lucky/hi")]
    public function hiMethod(): Response
    {
        return new Response(
            '<html><body>Hi to you!</body></html>'
        );
    }
}
