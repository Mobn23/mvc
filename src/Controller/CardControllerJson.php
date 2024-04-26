<?php

namespace App\Controller;

use App\Cards\CardGraphic;
use App\Cards\CardHand;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CardControllerJson extends AbstractController
{
    #[Route("/session/delete", name: "session_delete")]
    public function deleteSession(SessionInterface $session): Response
    {
        $session->clear();
        if(empty($session->all())) {
            $this->addFlash(
                'notice',
                'Nu är sessionen raderad!'
            );
        };
        return $this->redirectToRoute('session_display');
    }

    #[Route("/api/deck", name: "api_deck", methods:"GET")]
    public function apiDeck(): Response
    {
        $hand = new CardHand();
        $card = new CardGraphic();
        $card->getAllCardsAsString();
        $hand->add($card);

        $data = [
            "cardsSuits" => $hand->getAllValues()
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
            // | combines or merges
        );
        return $response;
    }

    #[Route("/api/deck/shuffle", name: "api_deck_shuffle", methods:"POST")]
    public function apiDeckShuffle(SessionInterface $session): Response
    {
        $this->deleteSession($session);
        $hand = new CardHand();
        $card = new CardGraphic();
        $card->getAllCardsAsString();
        $hand->add($card);
        $hand->roll();

        $data = [
            "cardsSuits" => $hand->getAllValues()
        ];

        $counter = [];
        foreach($data["cardsSuits"] as $suit) {
            $cards = str_split($suit);
            foreach ($cards as $card) {
                if (!in_array($card, $counter)) {
                    $counter[] = $card;
                }
            }
        }

        $session->set('remained_cards_num', count($counter) - 1);

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
            // | combines or merges
        );
        return $response;
    }

    #[Route("api/deck/draw", name: "api_deck_draw", methods: ["GET", "POST"])]
    public function apiDeckDraw(SessionInterface $session): Response
    {
        $hand = new CardHand();
        $cardGraphic = new CardGraphic();
        $randomCard = $cardGraphic->randomCard();
        $cardGraphic->setValue($randomCard);
        $hand->add($cardGraphic);
        print_r($randomCard);

        $data = [
            "randomCard" => $hand->getString(),
            "remainedCardsQuantity" => $cardGraphic->cardsArrayCount($randomCard)
        ];
        $sessionRemainedCards = $session->get('remained_cards_num', 0);
        $session->set('remained_cards_num', $sessionRemainedCards - 1);

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
            // | combines or merges
        );
        return $response;
    }

    #[Route("api/deck/draw/:{num<\d+>}", name: "api_deck_draw_number", methods: ["GET", "POST"])]
    public function apisDeckDraw(int $num, SessionInterface $session): Response
    {
        $hand = new CardHand();
        $cardGraphic = new CardGraphic();
        $randomCard = $cardGraphic->chosenCards($num);
        $cardGraphic->setValue($randomCard);
        $hand->add($cardGraphic);
        print_r($randomCard);

        $data = [
            "randomCard" => $hand->getValues(),
            "remainedCardsQuantity" => $cardGraphic->cardsNumberArrayCount($randomCard)
        ];
        $sessionRemainedCards = $session->get('remained_cards_num', 0);
        $session->set('remained_cards_num', $sessionRemainedCards - $num);

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
            // | combines or merges
        );
        return $response;
    }

}
