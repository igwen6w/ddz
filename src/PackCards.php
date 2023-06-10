<?php
namespace Igwen6w\Ddz;

use Igwen6w\Ddz\Card\JokerCard;
use Igwen6w\Ddz\Card\Rank\JokerRank;
use Igwen6w\Ddz\Card\Rank\RegularRank;
use Igwen6w\Ddz\Card\RegularCard;
use Igwen6w\Ddz\Card\Suit\JokerSuit;
use Igwen6w\Ddz\Card\Suit\RegularSuit;

class PackCards
{
    public array $cards;

    public function __construct()
    {
        $this->createJoker();
        $this->createRegular();
    }

    protected function createJoker(): void
    {
        $this->cards[] = new JokerCard(JokerRank::RedJoker, JokerSuit::RedJoker);
        $this->cards[] = new JokerCard(JokerRank::BlackJoker, JokerSuit::BlackJoker);
    }

    protected function createRegular(): void
    {
        foreach (RegularRank::cases() as $rank) {
            foreach(RegularSuit::cases() as $suit) {
                $this->cards[] = new RegularCard($rank, $suit);
            }
        }
    }

}