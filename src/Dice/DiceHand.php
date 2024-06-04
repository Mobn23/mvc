<?php

namespace App\Dice;

use App\Dice\Dice;

class DiceHand
{
    /**
     * @var array<object>
     */
    private $hand = [];

    public function add(Dice $die): void  //instead of instanciate the die outside we simply inject it as a parameter to the DiceHand.add() method.
    {
        $this->hand[] = $die;
    }

    /**
     *
     * This method rolls the die.
     */
    public function roll(): void
    {
        foreach ($this->hand as $die) {
            $die->roll();
        }
    }

    /**
     *
     * Returns the dices in hand quantity.
     * @return int.
     */
    public function getNumberDices(): int
    {
        return count($this->hand);
    }

    /**
     *
     * @return array<int>.
     */
    public function getValues(): array
    {
        $values = [];
        foreach ($this->hand as $die) {
            $values[] = $die->getValue();
        }
        return $values;
    }

    /**
     *
     * @return int.
     */
    public function sum(): int
    {
        $sum = 0;
        foreach ($this->hand as $die) {
            $sum += $die->getValue();
        }
        return $sum;
    }

    /**
     *
     * @return array<string>.
     */
    public function getString(): array
    {
        $values = [];
        foreach ($this->hand as $die) {
            $values[] = $die->getAsString();
        }
        return $values;
    }
}
