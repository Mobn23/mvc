<?php

namespace App\Cards;

use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertEquals;

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
}
