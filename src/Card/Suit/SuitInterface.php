<?php

namespace Igwen6w\Ddz\Card\Suit;

use Igwen6w\Ddz\Card\Color\ColorInterface;

interface SuitInterface
{
    public function color(): ColorInterface;
}