<?php
/**
 * description:
 * author: igwen6w@gmail.com
 * date: 2023/6/7
 */
namespace Igwen6w\Ddz\Card\Suit;

use Igwen6w\Ddz\Card\Color\RegularColor;

enum RegularSuit: string implements SuitInterface
{
    // 红桃
    case Hearts = 'H';
    // 方片
    case Diamonds = 'D';
    // 梅花
    case Clubs = 'C';
    // 黑桃
    case Spades = 'S';

    public function color(): RegularColor
    {
        return match ($this){
            RegularSuit::Hearts, RegularSuit::Diamonds  => RegularColor::Red,
            RegularSuit::Clubs, RegularSuit::Spades  => RegularColor::Black
        };
    }
}
