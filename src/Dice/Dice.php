<?php

namespace App\Dice;

class Dice
{
    protected $value;

    public function __construct()
    {
        $this->value = null;
    }

    /**
     * @return int
     */
    public function roll(): int
    {
        $this->value = random_int(1, 6);
        return $this->value;
    }

    /**
     * @return ?int
     */
    public function getValue(): ?int
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getAsString(): string
    {
        return "[{$this->value}]";
    }
}
