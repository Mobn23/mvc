<?php

namespace App\Dice;

/**
 * Class representing a Dice.
 */
class Dice
{
    /**
     * @var int|null The current value of the dice.
     */
    protected $value;

    /**
     * Dice constructor initializes the dice value to null.
     */
    public function __construct()
    {
        $this->value = null;
    }

    /**
     * Rolls the dice and sets its value.
     *
     * @return int The value after rolling the dice.
     */
    public function roll(): int
    {
        $this->value = random_int(1, 6);
        return $this->value;
    }

    /**
     * Gets the current value of the dice.
     *
     * @return int|null The current value, or null if not rolled yet.
     */
    public function getValue(): ?int
    {
        return $this->value;
    }

    /**
     * Gets the string representation of the dice value.
     *
     * @return string The string representation of the current value.
     */
    public function getAsString(): string
    {
        return "[{$this->value}]";
    }
}
