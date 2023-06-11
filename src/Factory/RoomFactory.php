<?php

namespace Igwen6w\Ddz\Factory;

use Igwen6w\Ddz\Room\RoomInterface;

interface RoomFactory
{
    public function createRoom(): RoomInterface;

}