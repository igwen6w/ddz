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
    protected array $cards;

    public function __construct()
    {
        $this->createJoker();
        $this->createRegular();
    }

    public function getCards(): array
    {
        return $this->cards;
    }

    public function shuffle()
    {
        shuffle($this->cards);
    }

    public function cut(): array
    {
        $array = [];
        foreach($this->cards as $key => $card) {
            if ($key > 50) {
                $array[3][] = $card;
            }
            $array[$key % 3][] = $card;
        }
        return $array;
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