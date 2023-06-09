<?php

namespace Igwen6w\Ddz\Card;

use Igwen6w\Ddz\Card\Rank\RegularRank;
use Igwen6w\Ddz\Card\Suit\RegularSuit;

class RegularCard extends AbstractCard
{
    public function __construct(RegularRank $rank, RegularSuit $suit)
    {
        $this->rank = $rank;
        $this->suit = $suit;
    }
}