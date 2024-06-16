<?php

namespace App\Cards;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Card.
 */
class CardTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties, use no arguments.
     */
    public function testCreateCard(): void
    {
        $card = new Card();
        $this->assertInstanceOf("\App\Cards\Card", $card);

        $card->setValue("🂢");
        $res = $card->getValue();
        $this->assertNotEmpty($res);

        $res = $card->getAsString();
        $this->assertNotEmpty($res);
    }

    /**
     * Test setting and getting card value.
     */
    public function testSetValueAndGetValue(): void
    {
        $card = new Card();
        $card->setValue("🂢");

        $res = $card->getValue();
        $this->assertEquals("🂢", $res);
    }

    /**
     * Test getting card value as string.
     */
    public function testGetAsString(): void
    {
        $card = new Card();
        $card->setValue("🂢");

        $res = $card->getAsString();
        $this->assertEquals("🂢", $res);
    }

    /**
     * Test getting all cards as string.
     */
    public function testGetAllCardsAsString(): void
    {
        $card = new Card();
        $card->setValue("🂢");

        $res = $card->getAllCardsAsString();
        $this->assertEquals("🂢", $res);
    }
}
