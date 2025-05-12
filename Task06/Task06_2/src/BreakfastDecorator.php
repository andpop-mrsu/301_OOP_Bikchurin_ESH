<?php

namespace App;

use App\Room;

class BreakfastDecorator extends RoomDecorator
{
    public function getDescription(): string
    {
        return $this->room->getDescription() . ', завтрак "шведский стол"';
    }

    public function getPrice(): float
    {
        return $this->room->getPrice() + 500;
    }
}
