<?php

namespace App\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class DiceGraphicTest.
 */
class DiceGraphicTest extends TestCase
{
    /**
     * check if DiceGraphic does not inherit from Dice.
     */
        public function testInheritance()
    {
        $diceGraphic = new DiceGraphic();
        $this->assertInstanceOf(Dice::class, $diceGraphic, 'DiceGraphic does not inherit from Dice.');
    }

    /**
     * check if The string representation does match the value.
     */
    public function testGetAsString()
    {
        $diceGraphic = new DiceGraphic();

        // Roll the dice to get a new value
        $diceGraphic->roll();
        $expectedString = $diceGraphic->getAsString();

        // Check if the string representation matches the value
        $this->assertEquals($diceGraphic->getAsString(), $expectedString, 'The string representation does not match the value.');
    }
}
