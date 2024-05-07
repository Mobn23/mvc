<?php

namespace App\Controller;

use App\Cards\Card;
use App\Cards\CardGraphic;
use App\Cards\CardHand;
use SebastianBergmann\Environment\Console;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CardGameController extends AbstractController
{
    #[Route("/session", name: "session_display")]
    public function sessionLandingPage(SessionInterface $session): Response
    {
        $sessionData = $session->all();
        dump($sessionData);
        $sessionDataString = json_encode($sessionData);
        return $this->render('cards/session_display.html.twig', [
            'sessionDataString' => $sessionDataString
        ]);
    }

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

        $hand = new CardHand();
        $card = new CardGraphic();
        $card->getAllCardsAsString();
        $hand->add($card);
        $counter = [];
        foreach($hand->getAllValues() as $suit) {
            $cards = str_split($suit);
            foreach ($cards as $card) {
                if (!in_array($card, $counter)) {
                    $counter[] = $card;
                }
            }
        }

        $session->set('remained_cards_num', count($counter) - 2);
        return $this->redirectToRoute('session_display');
    }

    #[Route("/card", name: "card")]
    public function card(): Response
    {
        return $this->render('cards/card.html.twig');
    }

    #[Route("card/deck", name: "card_deck")]
    public function cardDeck(): Response
    {
        $hand = new CardHand();
        $card = new CardGraphic();
        $card->getAllCardsAsString();
        $hand->add($card);

        $data = [
            "cardsSuits" => $hand->getAllValues()
        ];

        return $this->render('cards/test/carddeck.html.twig', $data);
    }

    #[Route("card/deck/shuffle", name: "card_deck_shuffle")]
    public function cardDeckShuffle(SessionInterface $session): Response
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

        // print_r($counter);
        // print_r($data["cardsSuits"]);

        return $this->render('cards/test/carddeck.html.twig', $data);
    }

    #[Route("card/deck/draw", name: "card_deck_draw")]
    public function cardDeckDraw(SessionInterface $session): Response
    {
        $hand = new CardHand();
        $cardGraphic = new CardGraphic();
        $randomCard = $cardGraphic->randomCard();
        $cardGraphic->setValue($randomCard);
        $hand->add($cardGraphic);
        print_r($randomCard);

        $sessionRemainedCards = $session->get('remained_cards_num', 0);
        $sessionFinal = $sessionRemainedCards - 1;
        $session->set('remained_cards_num', $sessionFinal);

        $data = [
            "randomCard" => $hand->getString(),
            "remainedCardsQuantity" => $sessionFinal
        ];

        return $this->render('cards/carddeckdraw.html.twig', $data);
    }

    #[Route("card/deck/draw/:{num<\d+>}", name: "card_deck_draw_number")]
    public function cardsDeckDraw(int $num, SessionInterface $session): Response
    {
        $hand = new CardHand();
        $cardGraphic = new CardGraphic();
        $randomCard = $cardGraphic->chosenCards($num);
        $cardGraphic->setValue($randomCard);
        $hand->add($cardGraphic);
        print_r($randomCard);

        $sessionRemainedCards = $session->get('remained_cards_num', 0);
        $sessionFinal = $sessionRemainedCards - $num;
        $session->set('remained_cards_num', $sessionFinal);

        $data = [
            "randomCard" => $hand->getValues(),
            "remainedCardsQuantity" => $sessionFinal
        ];
        return $this->render('cards/carddeckdrawnum.html.twig', $data);
    }
}
