<?php

namespace App\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Dice.
 */
class DiceTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties, use no arguments.
     */
    public function testCreateDice(): void
    {
        $die = new Dice();
        $this->assertInstanceOf("\App\Dice\Dice", $die);

        $res = $die->getAsString();
        $this->assertNotEmpty($res);
    }

    /**
     * Create a mocked object that always returns 6.
     */
    public function testStubRollDiceLastRoll(): void
    {
        // Create a stub for the Dice class.
        $stub = $this->createMock(Dice::class);

        // Configure the stub.
        $stub->method('roll')
            ->willReturn(6);

        $res = $stub->roll();
        $exp = 6;
        $this->assertEquals($exp, $res);
    }

    /**
     * testRoll() checks if the dice's value is greater or less than or equall the assumed value.
     */
    public function testRoll()
    {
        $dice = new Dice();

        $value = $dice->roll();
        $this->assertGreaterThanOrEqual(1, $value, 'The rolled value is less than 1.');
        $this->assertLessThanOrEqual(6, $value, 'The rolled value is greater than 6.');

        $this->assertEquals($value, $dice->getValue(), 'The getValue method did not return the rolled value.');
    }

}
