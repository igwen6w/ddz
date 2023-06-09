<?php

namespace Igwen6w\Ddz\Card\Rank;

enum JokerRank: string implements RankInterface
{
    case BlackJoker = 'Black Joker';
    case RedJoker = 'Red Joker';

    public function level(): int
    {
        return array_search($this, RegularRank::cases()) + 53;
    }
}
