<?php

namespace App\Controller;

use App\Dice\DiceGraphic;
use App\Dice\DiceHand;
use Exception;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DiceGameController extends AbstractController
{
    /**
     * Route("/game/pig/test/roll", name: "test_roll_dice")
     * @return Response
     */
    #[Route("/game/pig/test/roll", name: "test_roll_dice")]
    public function testRollDice(): Response
    {
        $die = new DiceGraphic(); // we call the instance and the class (object) for example : $die = new Dice();

        $data = [
            "dice" => $die->roll(),
            "diceString" => $die->getAsString(),
        ];

        return $this->render('pig/test/roll.html.twig', $data);
    }

    /**
     * Route("/game/pig/test/roll/{num<\d+>}", name: "test_roll_num_dices")
     * @param int $num number of dices will be rolled.
     * @return Response
     */
    #[Route("/game/pig/test/roll/{num<\d+>}", name: "test_roll_num_dices")]
    public function testRollDices(int $num): Response
    {
        if ($num > 99) {
            throw new Exception("Can not roll more than 99 dices!");
        }

        $diceRoll = [];
        for ($i = 1; $i <= $num; $i++) {
            // $die = new Dice();
            $die = new DiceGraphic();
            $die->roll();
            $diceRoll[] = $die->getAsString();
        }

        $data = [
            "num_dices" => count($diceRoll),
            "diceRoll" => $diceRoll,
        ];

        return $this->render('pig/test/roll_many.html.twig', $data);
    }

    /**
     * Route("/game/pig/test/dicehand/{num<\d+>}", name: "test_dicehand")
     * @param int $num number of dices will be displayed.
     * @return Response
     */
    #[Route("/game/pig/test/dicehand/{num<\d+>}", name: "test_dicehand")]
    public function testDiceHand(int $num): Response
    {
        if ($num > 99) {
            throw new Exception("Can not roll more than 99 dices!");
        }

        $hand = new DiceHand();
        for ($i = 1; $i <= $num; $i++) {
            $hand->add(new DiceGraphic());
        }

        $hand->roll();

        $data = [
            "num_dices" => $hand->getNumberDices(),
            "diceRoll" => $hand->getAllValues(),
        ];

        return $this->render('pig/test/dicehand.html.twig', $data);
    }

    /**
     * Route("/game/pig/play", name: "pig_play", methods: ['GET'])
     * @param SessionInterface $session
     * @return Response
     */
    #[Route("/game/pig/play", name: "pig_play", methods: ['GET'])]
    public function play(
        SessionInterface $session
    ): Response {
        $dicehand = $session->get("pig_dicehand");

        $data = [
            "pigDices" => $session->get("pig_dices"),
            "pigRound" => $session->get("pig_round"),
            "pigTotal" => $session->get("pig_total"),
            "diceValues" => $dicehand->getString()
        ];

        return $this->render('pig/play.html.twig', $data);
    }

    /**
     * Route("/game/pig/roll", name: "pig_roll", methods: ['POST'])
     * @param SessionInterface $session
     * @return Response
     */
    #[Route("/game/pig/roll", name: "pig_roll", methods: ['POST'])]
    public function roll(
        SessionInterface $session
    ): Response {
        $hand = $session->get("pig_dicehand");
        $hand->roll();

        $roundTotal = $session->get("pig_round");
        $round = 0;
        $values = $hand->getValues();
        foreach ($values as $value) {
            if ($value === 1) {
                $round = 0;
                $roundTotal = 0;

                $this->addFlash(
                    'warning',
                    'You got a 1 and you lost the round points!'
                );

                break;
            }
            $round += $value;
        }

        $session->set("pig_round", $roundTotal + $round);

        return $this->redirectToRoute('pig_play');
    }

    /**
     * Route("/game/pig/save", name: "pig_save", methods: ['POST'])
     * @param SessionInterface $session
     * @return Response
     */
    #[Route("/game/pig/save", name: "pig_save", methods: ['POST'])]
    public function save(
        SessionInterface $session
    ): Response {
        $roundTotal = $session->get("pig_round");
        $gameTotal = $session->get("pig_total");

        $session->set("pig_round", 0);
        $session->set("pig_total", $roundTotal + $gameTotal);

        $this->addFlash(
            'notice',
            'Your round was saved to the total!'
        );
        return $this->redirectToRoute('pig_play');
    }
}
