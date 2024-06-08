<?php

namespace App\Dice;

use PHPUnit\Framework\TestCase;
use App\Repository\BookRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Test cases for class DiceHand.
 */
class BookRepositoryTest extends TestCase
{
    /**
     * Stub the dices to assure the value can be asserted.
     */
    public function testGetMaxId(): void
    {
        $managerRegistryMock = $this->createMock(ManagerRegistry::class);

        $bookRepositoryMock = $this->getMockBuilder(BookRepository::class)
            ->setConstructorArgs([$managerRegistryMock])
            ->onlyMethods(['getMaxId'])
            ->getMock();

        $bookRepositoryMock->expects($this->once())
            ->method('getMaxId')
            ->willReturn(10);

        $maxId = $bookRepositoryMock->getMaxId();
        $this->assertEquals(10, $maxId);
    }
}
