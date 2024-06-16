<?php

namespace App\Cards;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class CardGraphic.
 */
class CardGraphicTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties, use no arguments.
     */
    public function testCreateCardGraphic(): void
    {
        $cardGraphic = new CardGraphic();
        $this->assertInstanceOf("\App\Cards\CardGraphic", $cardGraphic);

        $res = $cardGraphic->getRepresentation();
        $this->assertNotEmpty($res);
    }

    public function testGetAllCardsAsString(): void
    {
        $cardGraphic = new CardGraphic();
        $res = $cardGraphic->getAllCardsAsString();
        $this->assertNotEmpty($res);
    }

    public function testRoll(): void
    {
        $cardGraphic = new CardGraphic();
        $res = $cardGraphic->getRepresentation();
        $res2 = $cardGraphic->roll();
        $this->assertNotEquals($res, $res2);
    }

    public function testRandomCard(): void
    {
        $cardGraphic = new CardGraphic();
        $randomCard = $cardGraphic->randomCard();
        $representationKeys = array_keys($cardGraphic->getRepresentation());
        $this->assertNotContains($randomCard, $representationKeys);

        $stub = $this->createMock(CardGraphic::class);
        // Configure the stub.
        $stub->method('randomCard')
            ->willReturn('🂢');

        $res = $stub->randomCard();
        $exp = '🂢';
        $this->assertEquals($exp, $res);
        $this->assertNotEmpty($res);
    }

    public function testCardsArrayCount(): void
    {
        $cardGraphic = new CardGraphic();
        $res = $cardGraphic->cardsArrayCount('🂢');
        $exp = 51;
        $this-> assertEquals($res, $exp);
    }

    public function testChosenCards(): void
    {
        $cardGraphic = new CardGraphic();
        $res = $cardGraphic-> chosenCards(1);
        $this-> assertNotEmpty($res);
    }
}
