<?php

namespace Igwen6w\Ddz\Card;

use Igwen6w\Ddz\Card\Rank\JokerRank;
use Igwen6w\Ddz\Card\Suit\JokerSuit;

class JokerCard extends AbstractCard
{
    public function __construct(JokerRank $rank, JokerSuit $suit)
    {
        $this->rank = $rank;
        $this->suit = $suit;
    }
}