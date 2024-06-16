<?php

namespace App\Cards;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Player.
 */
class PlayerTest extends TestCase
{
    /**
     * Test the constructor and getters.
     */
    public function testConstructorAndGetters()
    {
        $name = 'John Doe';
        $bet = 100;

        $player = new Player($name, $bet);

        $this->assertEquals($name, $player->getName());
        $this->assertEquals($bet, $player->getBet());
    }

    /**
     * Test the setBet method.
     */
    public function testSetBet()
    {
        $name = 'John Doe';
        $bet = 100;
        $newBet = 200;

        $player = new Player($name, $bet);
        $player->setBet($newBet);

        $this->assertEquals($newBet, $player->getBet());
    }

    /**
     * Test the testToArray method.
     */
    public function testToArray()
    {
        // Arrange
        $name = 'John Doe';
        $bet = 100;
        $player = new Player($name, $bet);

        // Act
        $result = $player->toArray();

        // Assert
        $expected = [
            'name' => $name,
            'bet' => $bet,
        ];

        $this->assertEquals($expected, $result);
    }
}
