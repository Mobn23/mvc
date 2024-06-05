<?php

namespace App\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class DiceHand.
 */
class DiceHandTest extends TestCase
{
    /**
     * Stub the dices to assure the value can be asserted.
     */
    public function testAddStubbedDices(): void
    {
        // Create a stub for the Dice class.
        $stub = $this->createMock(Dice::class);

        // Configure the stub.
        $stub->method('roll')
            ->willReturn(6);
        $stub->method('getValue')
            ->willReturn(6);

        $dicehand = new DiceHand();
        $dicehand->add(clone $stub);
        $dicehand->add(clone $stub);
        $dicehand->roll();
        $res = $dicehand->sum();
        $this->assertEquals(12, $res);
    }

    /**
     * Tests the RollReturn method.
     */
    public function testRollReturn(): void
    {
        $dicehand = new DiceHand();
        $dice = new Dice();
        $dicehand->add($dice);

        $result = $dicehand->rollReturn();
        $this->assertCount(1, $result);
        $this->assertInstanceOf(Dice::class, $result[0]);
    }

    /**
     * Tests the getNumberDices method.
     */
    public function testGetNumberDices(): void
    {
        $dicehand = new DiceHand();
        $dice = new Dice();
        $dicehand->add($dice);

        $result = $dicehand->getNumberDices();
        $this->assertEquals(1, $result);
    }

    /**
     * Tests the getValues method.
     */
    public function testGetValues(): void
    {
        $dicehand = new DiceHand();
        $dice1 = new Dice();
        $dice2 = new Dice();
        $dicehand->add($dice1);
        $dicehand->add($dice2);
        $dicehand->roll();

        $result = $dicehand->getValues();
        $this->assertCount(2, $result);
        $this->assertContainsOnly('int', $result);
    }

    /**
     * Tests the getAllValues method.
     */
    public function testGetAllValues(): void
    {
        $dicehand = new DiceHand();
        $dice1 = new Dice();
        $dice2 = new Dice();
        $dice1->roll();
        $dice2->roll();
        $dicehand->add($dice1);
        $dicehand->add($dice2);

        $result = $dicehand->getAllValues();
        $this->assertCount(2, $result);
        $this->assertContainsOnly('string', $result);
    }
}
