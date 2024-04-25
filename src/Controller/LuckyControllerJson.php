<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LuckyControllerJson
{
    // #[Route("api/")]
    // public function jsonLucky(): Response
    // {
    //     $number = random_int(0, 100);
    //     $videoPath = 'videos/crazy-video.mp4';

    //     $data = [
    //         'number' => $number,
    //         'videoPath' => $videoPath
    //     ];

    //     $response = new JsonResponse($data);
    //     $response->setEncodingOptions(
    //         $response->getEncodingOptions() | JSON_PRETTY_PRINT
    //         // | combines or merges
    //     );
    //     return $response;
    // }

    #[Route("/api/quote", name: "quote")]
    public function apiQuote(): Response
    {
        date_default_timezone_set('Europe/Stockholm');

        $quotes = [
            "If u look to the people in ur circle and u don't get inspired, u don't have a circle, u have a cage",
            "The only one who can stop u is u.",
            "U shouldn't drink poison just because u r thirsty"
        ];

        $randomQuote = $quotes[array_rand($quotes)];

        $responseData = [
            'quote' => $randomQuote,
            'date' => date('Y-m-d'),
            'timestamp' => date('H:i:s')
        ];

        $response = new JsonResponse($responseData);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
            // | combines or merges
        );
        return $response;
    }
}
