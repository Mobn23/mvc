<?php

namespace App\Cards;

class CardRepresentation
{
    /**
     * @var array<string, string>
     */
    private array $representation = [
        // clubs
        '🃑' => 'A',
        '🃒' => '2',
        '🃓' => '3',
        '🃔' => '4',
        '🃕' => '5',
        '🃖' => '6',
        '🃗' => '7',
        '🃘' => '8',
        '🃙' => '9',
        '🃚' => '10',
        '🃛' => 'J',
        '🃝' => 'Q',
        '🃞' => 'K',
        // Spades
        '🂡' => 'A',
        '🂢' => '2',
        '🂣' => '3',
        '🂤' => '4',
        '🂥' => '5',
        '🂦' => '6',
        '🂧' => '7',
        '🂨' => '8',
        '🂩' => '9',
        '🂪' => '10',
        '🂫' => 'J',
        '🂭' => 'Q',
        '🂮' => 'K',
        // Hearts
        '🂱' => 'A',
        '🂲' => '2',
        '🂳' => '3',
        '🂴' => '4',
        '🂵' => '5',
        '🂶' => '6',
        '🂷' => '7',
        '🂸' => '8',
        '🂹' => '9',
        '🂺' => '10',
        '🂻' => 'J',
        '🂽' => 'Q',
        '🂾' => 'K',
        // Diamonds
        '🃁' => 'A',
        '🃂' => '2',
        '🃃' => '3',
        '🃄' => '4',
        '🃅' => '5',
        '🃆' => '6',
        '🃇' => '7',
        '🃈' => '8',
        '🃉' => '9',
        '🃊' => '10',
        '🃋' => 'J',
        '🃍' => 'Q',
        '🃎' => 'K',
    ];

    /**
     * Gets the representation array.
     *
     * @return array<string, string>
     */
    public function getRepresentation(): array
    {
        return $this->representation;
    }

    /**
     * Sets the representation array.
     */
    public function setRepresentation(array $representation): void
    {
        $this->representation = $representation;
    }

    /**
     * Returns all cards as a string.
     *
     * @return string
     */
    public function getAllCardsAsString(): string
    {
        return implode('', array_keys($this->representation));
    }

    /**
     * Returns the rank of a card given its symbol. For clarifying the code.
     *
     * @param string $symbol The symbol of the card.
     * @return string|null The rank of the card.
     */
    public function getRank(string $symbol): ?string
    {
        return $this->representation[$symbol] ?? null;
    }
}
