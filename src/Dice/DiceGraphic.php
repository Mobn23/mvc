<?php

namespace App\Dice;

class DiceGraphic extends Dice
{
    /**
     * @var array<string>
     */
    private $representation = [
        '⚀',
        '⚁',
        '⚂',
        '⚃',
        '⚄',
        '⚅',
    ];

    /**
     * construct takes the dice's super class construct.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return string
     */
    public function getAsString(): string
    {
        return $this->representation[$this->value - 1];
    }
}
