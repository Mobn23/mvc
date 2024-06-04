<?php

namespace App\Controller;

use App\Cards\CardGraphic;
use App\Cards\CardHand;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CardGameControllerTwigAndSession extends AbstractController
{
    /**
     * @Route("/session", name: "session_display")
     * @param SessionInterface $session
     * @return Response
     */
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

    /**
     * @Route("/session/delete", name: "session_delete")
     * @param SessionInterface $session
     * @return Response
     */
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

    /**
     * @Route("/card", name: "card")
     * @return Response
     */
    #[Route("/card", name: "card")]
    public function card(): Response
    {
        return $this->render('cards/card.html.twig');
    }
}
