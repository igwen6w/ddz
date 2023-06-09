<?php

namespace Igwen6w\Ddz\Card\Rank;

enum RegularRank: string implements RankInterface
{
    case Two = '2';
    case Three = '3';
    case Four = '4';
    case Five = '5';
    case Six = '6';
    case Seven = '7';
    case Eight = '8';
    case Nine = '9';
    case Ten = '10';
    case Jack = 'J';
    case Queen = 'Q';
    case King = 'K';
    case Ace = 'A';

    public function level(): int
    {
        return array_search($this, RegularRank::cases()) + 1;
    }
}