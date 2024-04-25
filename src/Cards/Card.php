<?php

namespace App\Cards;

class Card
{
    protected $value;

    public function __construct()
    {
        $this->value = null;
    }

    public function setValue($value): void
    {
        $this->value = $value;
    }

    public function getValue(): array
    {
        return $this->value;
    }

    public function getAsString(): string
    {
        return "{$this->value}";
    }
}
