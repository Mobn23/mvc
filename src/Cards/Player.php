<?php

namespace App\Cards;

/**
 * Class Player
 *
 * Represents a player in the game with a name and a bet.
 */
class Player
{
    /**
     * @var string $name The name of the player.
     */
    private $name;

    /**
     * @var int $bet The bet amount of the player.
     */
    private $bet;

    /**
     * Player constructor.
     *
     * @param string $name The name of the player.
     * @param int $bet The initial bet amount.
     */
    public function __construct(string $name, int $bet)
    {
        $this->name = $name;
        $this->bet = $bet;
    }

    /**
     * Get the name of the player.
     *
     * @return string The name of the player.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get the bet amount of the player.
     *
     * @return int The bet amount.
     */
    public function getBet(): int
    {
        return $this->bet;
    }

    /**
     * Set the bet amount for the player.
     *
     * @param int $bet The new bet amount.
     */
    public function setBet(int $bet)
    {
        $this->bet = $bet;
    }

    /**
     * Get the name and bet amount of the player.
     *
     * @return array The bet amount and the name.
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'bet' => $this->bet,
        ];
    }
}
