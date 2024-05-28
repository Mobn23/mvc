<?php

namespace App\Cards;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class CardHand.
 */
class CardHandTest extends TestCase
{
    /**
     * Stub the Cards to assure the value can be asserted.
     */
    public function testAddStubbedCards(): void
    {
        // Create a stub for the Card class.
        $stub = $this->createMock(CardGraphic::class);

        // Configure the stub.
        $stub->method('randomCard')
            ->willReturn('🃊');

        $cardHand = new CardHand();
        $cardHand->add(clone $stub);
        $cardHand->roll();
        $res = '🃊';
        $this->assertEquals('🃊', $res);
    }

    public function testGetAllValues(): void
    {
        $cardHand = new CardHand();
        $stub = $this->createMock(CardGraphic::class);
        $stub->method('getAllCardsAsString')
            ->willReturn('🃊');
        $cardHand->add(clone $stub) ;
        $res = $cardHand->getAllValues();
        $exp = ['🃊'];
        $this-> assertEquals($exp, $res);
    }

    public function testGetValues(): void
    {
        $cardHand = new CardHand();
        $stub = $this->createMock(CardGraphic::class);
        $stub->method('getValue')
            ->willReturn('🃊');
        $cardHand->add(clone $stub) ;
        $res = $cardHand->getValues();
        $exp = ['🃊'];
        $this-> assertEquals($exp, $res);
    }

    public function testGetString(): void
    {
        $cardHand = new CardHand();
        $stub = $this->createMock(CardGraphic::class);
        $stub->method('getAsString')
            ->willReturn('🃊');
        $cardHand->add(clone $stub) ;
        $res = $cardHand->getString();
        $exp = ['🃊'];
        $this-> assertEquals($exp, $res);
    }

    public function testGetNumberCards(): void
    {
        $cardHand = new CardHand();
        $stub = $this->createMock(CardGraphic::class);
        $stub->method('getAsString')
            ->willReturn('🃊');
        $cardHand->add(clone $stub) ;
        $res = $cardHand->getNumberCards();
        $exp = 1;
        $this-> assertEquals($exp, $res);
    }
}
