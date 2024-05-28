<?php

namespace App\Cards;

class CardGraphic extends Card
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

    // /**
    //  * @var array<string, string>
    //  */
    // private array $newArray = [];

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Gets the representation array.
     *
     * @return array<string, string>.
     */
    public function getRepresentation(): array
    {
        return $this->representation;
    }

    /**
     *
     * @return string
     */
    public function getAllCardsAsString(): string
    {
        $cardsAsString = '';
        foreach ($this->representation as $key => $card) {
            $cardsAsString .= $key;
        }
        return $cardsAsString;
    }

    public function roll(): void
    {
        shuffle($this->representation);
    }

    /**
     * Returns a random card from the representation.
     *
     * @return string
     */
    public function randomCard(): string
    {
        $keys = array_keys($this->representation);
        shuffle($keys);
        $randomKey = $keys[array_rand($keys)];
        return $randomKey;
    }

    /**
     * Returns an the count of representation except the randomly chosen cards.
     *
     * @return int the count of cards.
     */
    public function cardsArrayCount(string $randomCard): int
    {
        if (array_key_exists($randomCard, $this->representation)) {
            // If the card is found, remove it from the array
            unset($this->representation[$randomCard]);
        }
        return count($this->representation);
    }

    /**
     * Returns an array of randomly chosen cards.
     *
     * @param int $number The number of cards to choose.
     * @return string An array containing randomly chosen cards.
     */
    public function chosenCards($number): string
    {
        $keys = array_keys($this->representation);
        $chosenCards = "";
        shuffle($keys);
        $randomKey = $keys[array_rand($keys)];
        for($i = 0; $i < $number; $i++) {
            $keys = array_keys($this->representation);
            shuffle($keys);
            $randomKey = $keys[array_rand($keys)];
            $chosenCards .= $randomKey;
        }
        return $chosenCards;
    }

    // public function cardsNumberArrayCount($chosenCards): string
    // {
    //     foreach($chosenCards as $card) {
    //         $key = array_search($card, $this->newArray);
    //         unset($this->newArray[$key]);
    //     }
    //     return count($this->newArray);
    // }
}
