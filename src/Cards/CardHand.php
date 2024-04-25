<?php

namespace App\Cards;

use App\Cards\CardGraphic;

class CardHand
{
    private $hand = [];

    public function add(CardGraphic $cardGraphic): void  //instead of instanciate the die outside we simply inject it as a parameter to the CardHand.add() method.
    {
        $this->hand[] = $cardGraphic;
    }

    public function roll(): array
    {
        $values = [];
        foreach ($this->hand as $card) {
            $values[] = $card->roll();
        }
        return $values;
    }

    public function getNumberCards(): int
    {
        return count($this->hand);
    }

    public function getAllValues(): array
    {
        $values = [];
        foreach ($this->hand as $card) {
            $values[] = $card->getAllCardsAsString();
        }
        return $values;
    }

    public function getValues(): array
    {
        $values = [];
        foreach ($this->hand as $card) {
            $values[] = $card->getValue();
        }
        return $values;
    }

    public function getString(): array
    {
        $values = [];
        foreach ($this->hand as $card) {
            $values[] = $card->getAsString();
        }
        return $values;
    }

    // public function sortCards(): array
    // {
    //     usort($this->hand, function ($a, $b) {
    //         return strcmp($a->getValue(), $b->getValue());
    //     });
    //     // Separate cards by suit
    //     $suits = [
    //         'hearts' => [],
    //         'diamonds' => [],
    //         'clubs' => [],
    //         'spades' => []
    //     ];
    
    //     $lastCard = null; // Initialize $lastCard variable
    
    //     // Iterate through each card and separate them by suit
    //     foreach ($this->hand as $card) {
    //         // Get the Unicode code point of the card
    //         $codePoint = mb_ord($card->getAsString());
            
    //         // Determine the suit based on the code point range
    //         if ($codePoint >= 127153 && $codePoint <= 127167) {
    //             $suits['hearts'][] = $card;
    //         } elseif ($codePoint >= 127169 && $codePoint <= 127183) {
    //             $suits['diamonds'][] = $card;
    //         } elseif ($codePoint >= 127285 && $codePoint <= 127299) {
    //             $suits['clubs'][] = $card;
    //         } elseif ($codePoint >= 127237 && $codePoint <= 127251) {
    //             $suits['spades'][] = $card;
    //         }
    //         $lastCard = $card; // Update $lastCard with the current card
    //     }
    
    //     // Return both the sorted suits array and the last card processed
    //     return ['suits' => $suits, 'lastCard' => $lastCard];
    // }
}
