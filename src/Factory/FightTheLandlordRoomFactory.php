<?php

namespace Igwen6w\Ddz\Factory;

use Igwen6w\Ddz\Room\FightTheLandlord;
use Igwen6w\Ddz\Room\RoomInterface;

class FightTheLandlordRoomFactory implements RoomFactory
{

    public function createRoom(): RoomInterface
    {
        return new FightTheLandlord();
    }

}