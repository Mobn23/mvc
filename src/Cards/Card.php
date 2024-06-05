<?php

namespace App\Cards;

use App\Cards\CardGraphic;

class Card
{
    protected string $value;

    public function __construct()
    {
        $this->value = "";
    }

    /** @param string $value */
    public function setValue($value): void
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @return string.
     */
    public function getAsString(): string
    {
        return $this->value;
    }

    /**
     *
     * @return string
     */
    public function getAllCardsAsString(): string
    {
        return $this->value;
    }
}
