<?php

namespace App\Cards;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Game.
 */
class GameTest extends TestCase
{
    public function testDrawCard(): void
    {
        $stub = $this->createMock(CardGraphic::class);
        $stub->method('randomCard')
            ->willReturn('🂺');
        $stub->method('getAsString')
            ->willReturn('🂺');
        $game = new Game();
        // $game->setCardGraphic($stub);
        $game->drawCard();
        $res = $game->getHandArray();
        // $exp = [['🂺']];
        $this->assertNotEmpty($res);
    }

    public function testCalculateHandValue(): void
    {
        $hand = [[
            '🃙',
            '🃚',
            '🃛',
        ]];
        $game = new Game();
        $game->setHand($hand);

        $res = $game->calculateHandValue();

        $this->assertEquals(9, $res);
        // $this->assertNotEmpty($res);
    }

    // public function testSetCardGraphic()
    // {
    //     $stub = $this->createMock(CardGraphic::class);
    //     $stub->method('randomCard')
    //         ->willReturn('🂺');
    //     $stub->method('getAsString')
    //         ->willReturn('🂺');
    //     $game = new Game($stub);
    //     $game->drawCard();
    //     $res = $game->getHandArray();
    //     $exp = [['🂺']];
    //     $this->assertEquals($exp, $res);
    // }
}
