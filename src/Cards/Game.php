<?php

namespace App\Cards;

use App\Cards\CardGraphic;

class Game
{
    /**
     * This is tha hand array.
     * @var array<array<string>|string>
     */
    private array $hand = [];

    /**
     *
     * This method draws a random card.
     * @return array<string>
     */
    public function drawCard(): array
    {
        $hand = new CardHand();
        $cardGraphic = new CardGraphic();
        $randomCard = $cardGraphic->randomCard();
        $cardGraphic->setValue($randomCard);
        $hand->add($cardGraphic);
        $cardString = $hand->getString();
        $this->hand[] = $cardString;
        print_r($randomCard);
        return $cardString;
    }

    /**
     *
     * This method sets a unicode(string) card to the hand array (used for unittests).
     * @param array<array<string>> $hand unicode cards array.
     */
    public function setHand(array $hand): void
    {
        $this->hand = $hand;
    }

    /**
     *
     * This method returns the hand array.
     * @return array<array<string>|string>
     */
    public function getHandArray(): array
    {
        return $this->hand;
    }

    /**
     *
     * This method returns the total values of the hand's array cards depending on what the card is.
     * @return int
     */
    public function calculateHandValue(): float|int
    {
        $total = 0;
        foreach ($this->hand as $card) {
            // dump($card);
            $cardGraphic = new CardGraphic();
            $value = $cardGraphic->getRepresentation()[$card[0]];
            // dump($value);
            if (is_numeric($value)) {
                $total += $value;
            }
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
        return $total;
    }
}
