<?php

namespace App\Cards;

class CardRepresentation
{
    /**
     * @var array<string, string>
     */
    private array $representation = [
        // Spades
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
        // Hearts
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
        // Diamonds
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
        // Clubs
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
     * Returns all cards as a string.
     *
     * @return string
     */
    public function getAllCardsAsString(): string
    {
        return implode('', array_keys($this->representation));
    }
}
