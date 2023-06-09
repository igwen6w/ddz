<?php

namespace Igwen6w\Ddz\Card\Suit;

use Igwen6w\Ddz\Card\Color\RegularColor;

enum JokerSuit: string implements SuitInterface
{
    case RedJoker = 'Red Joker';
    case BlackJoker = 'Black Joker';

    public function color(): RegularColor
    {
        return match ($this) {
            JokerSuit::BlackJoker => RegularColor::Black,
            JokerSuit::RedJoker => RegularColor::Red
        };
    }
}
