<?php

namespace App\Cards;

class CardDeck
{
    private CardRepresentation $cardRepresentation;

    public function __construct(CardRepresentation $cardRepresentation)
    {
        $this->cardRepresentation = $cardRepresentation;
    }

    /**
     * Shuffles the card representation.
     */
    public function shuffle(): void
    {
        $representation = $this->cardRepresentation->getRepresentation();
        shuffle($representation);
        $this->cardRepresentation = new CardRepresentation($representation);
    }

    /**
     * Returns a random card from the representation.
     *
     * @return string
     */
    public function randomCard(): string
    {
        $keys = array_keys($this->cardRepresentation->getRepresentation());
        shuffle($keys);
        return $keys[array_rand($keys)];
    }

    /**
     * Returns the count of cards in the representation excluding the randomly chosen cards.
     *
     * @param string $randomCard
     * @return int
     */
    public function cardsArrayCount(string $randomCard): int
    {
        $representation = $this->cardRepresentation->getRepresentation();
        if (array_key_exists($randomCard, $representation)) {
            unset($representation[$randomCard]);
        }
        return count($representation);
    }

    /**
     * Returns an array of randomly chosen cards.
     *
     * @param int $number The number of cards to choose.
     * @return string
     */
    public function chosenCards(int $number): string
    {
        $keys = array_keys($this->cardRepresentation->getRepresentation());
        $chosenCards = '';
        for ($i = 0; $i < $number; $i++) {
            shuffle($keys);
            $chosenCards .= $keys[array_rand($keys)];
        }
        return $chosenCards;
    }
}
