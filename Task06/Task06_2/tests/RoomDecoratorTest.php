<?php

namespace App\Tests;

use App\RoomDecorator;
use App\DinnerDecorator;
use App\FoodDeliveryDecorator;
use App\EconomyRoom;
use App\InternetDecorator;
use App\LuxuryRoom;
use App\SofaDecorator;
use App\BreakfastDecorator;
use App\StandardRoom;
use PHPUnit\Framework\TestCase;

class RoomDecoratorTest extends TestCase
{
    public function testBasicRoomTypes(): void
    {
        $economy = new EconomyRoom();
        $standard = new StandardRoom();
        $luxury = new LuxuryRoom();

        $this->assertRoomDetails($economy, "Эконом", 1000);
        $this->assertRoomDetails($standard, "Стандарт", 2000);
        $this->assertRoomDetails($luxury, "Люкс", 3000);
    }

    public function testSingleDecoratorApplied(): void
    {
        $room = new StandardRoom();
        $decoratedRoom = new InternetDecorator($room);

        $this->assertStringContainsString("выделенный Интернет", $decoratedRoom->getDescription());
        $this->assertEquals(2100, $decoratedRoom->getPrice());
        $this->assertInstanceOf(InternetDecorator::class, $decoratedRoom);
    }

    public function testMultipleDecoratorsInDifferentOrder(): void
    {
        $room1 = new StandardRoom();
        $room1 = new InternetDecorator($room1);
        $room1 = new BreakfastDecorator($room1);

        $room2 = new StandardRoom();
        $room2 = new BreakfastDecorator($room2);
        $room2 = new InternetDecorator($room2);

        $this->assertEquals(2300, $room1->getPrice());
        $this->assertEquals(2300, $room2->getPrice());
        $this->assertNotEquals($room1->getDescription(), $room2->getDescription());
    }

    public function testAllPossibleDecoratorsCombination(): void
    {
        $room = new LuxuryRoom();
        $services = [
            new InternetDecorator($room),
            new SofaDecorator($room),
            new FoodDeliveryDecorator($room),
            new BreakfastDecorator($room),
            new DinnerDecorator($room)
        ];

        $fullyDecorated = $room;
        foreach ($services as $service) {
            $fullyDecorated = $service;
        }

        $this->assertEquals(5200, $fullyDecorated->getPrice());
        $this->assertStringContainsString("Люкс", $fullyDecorated->getDescription());
        $this->assertStringContainsString("ужин", $fullyDecorated->getDescription());
    }

    public function testDecoratorChainIntegrity(): void
    {
        $room = new EconomyRoom();
        $decorated = new BreakfastDecorator(
            new DinnerDecorator(
                new FoodDeliveryDecorator($room)
            )
        );

        $description = $decorated->getDescription();

        $this->assertStringStartsWith("Эконом", $description);
        $this->assertStringContainsString("доставка еды в номер", $description);
        $this->assertStringContainsString("ужин", $description);
        $this->assertEquals(2400, $decorated->getPrice());
    }

    public function testEmptyDecorator(): void
    {
        $room = new LuxuryRoom();
        $this->assertRoomDetails($room, "Люкс", 3000);
    }

    public function testPriceCalculationWithMultipleDecorators(): void
    {
        $room = new EconomyRoom();
        $room = new BreakfastDecorator($room);
        $room = new DinnerDecorator($room);

        $this->assertEquals(2300, $room->getPrice());
    }

    private function assertRoomDetails($room, string $expectedDescription, int $expectedPrice): void
    {
        $this->assertEquals($expectedDescription, $room->getDescription());
        $this->assertEquals($expectedPrice, $room->getPrice());
    }
}