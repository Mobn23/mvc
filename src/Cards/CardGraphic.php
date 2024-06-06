<?php

namespace App\Cards;

/**
 * Class CardGraphic
 *
 * Represents a graphical card that extends the basic card functionality.
 */
class CardGraphic extends Card
{
    /**
     * @var CardDeck
     */
    private CardDeck $cardDeck;

    /**
     * @var CardRepresentation
     */
    private CardRepresentation $cardRepresentation;

    /**
     * CardGraphic constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->cardRepresentation = new CardRepresentation();
        $this->cardDeck = new CardDeck($this->cardRepresentation);
    }

    /**
     * Gets all cards as a single string.
     *
     * @return string
     */
    public function getAllCardsAsString(): string
    {
        return $this->cardRepresentation->getAllCardsAsString();
    }

    /**
     * Shuffles the deck of cards.
     */
    public function roll(): void
    {
        $cards = $this->cardRepresentation->getRepresentation();
        $keys = array_keys($cards);
        shuffle($keys);
        $shuffledRepresentation = [];
        foreach ($keys as $key) {
            $shuffledRepresentation[$key] = $cards[$key];
        }
        $this->cardRepresentation->setRepresentation($shuffledRepresentation);
    }

    /**
     * Returns a random card from the deck.
     *
     * @return string
     */
    public function randomCard(): string
    {
        return $this->cardDeck->randomCard();
    }

    /**
     * Returns the count of cards in the deck excluding a specified card.
     *
     * @param string $randomCard The card to exclude.
     * @return int
     */
    public function cardsArrayCount(string $randomCard): int
    {
        return $this->cardDeck->cardsArrayCount($randomCard);
    }

    /**
     * Returns a string containing a specified number of randomly chosen cards.
     *
     * @param int $number The number of cards to choose.
     * @return string
     */
    public function chosenCards(int $number): string
    {
        return $this->cardDeck->chosenCards($number);
    }

    /**
     * Gets the representation array.
     *
     * @return array<string, string>
     */
    public function getRepresentation(): array
    {
        return $this->cardRepresentation->getRepresentation();
    }
}
