<?php

namespace App\Cards;

use App\Cards\CardGraphic;

class Game
{
    /**
     * @var array<array<string>|string>.
     */
    private array $hand = [];

    public function drawCard(): void
    {
        $hand = new CardHand();
        $cardGraphic = new CardGraphic();
        $randomCard = $cardGraphic->randomCard();
        $cardGraphic->setValue($randomCard);
        $hand->add($cardGraphic);
        $cardString = $hand->getString();
        $this->hand[] = $cardString;
        print_r($randomCard);
    }

    /**
     *
     * @return array<array<string>|string>.
     */
    public function getHandArray(): array
    {
        return $this->hand;
    }

    public function calculateHandValue(): float|int
    {
        $total = 0;
        foreach ($this->hand as $card) {
            dump($card);
            $cardGraphic = new CardGraphic();
            $value = $cardGraphic->getRepresentation()[$card[0]];
            dump($value);
            if (is_numeric($value)) {
                $total += $value;
            } else {
                switch ($value) {
                    case 'A':
                        $total += ($total + 14 <= 21) ? 14 : 1;
                        break;
                    case 'J':
                    case 'Q':
                    case 'K':
                        $total += 10;
                        break;
                    default:
                        break;
                }
            }
        }
        return $total;
    }
}
