<?php

namespace App\Cards;

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

    public function getAsString(): string
    {
        return $this->value;
    }
}
