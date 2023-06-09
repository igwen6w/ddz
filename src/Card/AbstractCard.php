<?php

namespace Igwen6w\Ddz\Card;

use Igwen6w\Ddz\Card\Color\ColorInterface;
use Igwen6w\Ddz\Card\Rank\RankInterface;
use Igwen6w\Ddz\Card\Suit\SuitInterface;

abstract class AbstractCard implements CardInterface
{
    protected RankInterface $rank;
    protected SuitInterface $suit;

    public function getRank(): RankInterface
    {
        return $this->rank;
    }

    public function getSuit(): SuitInterface
    {
        return $this->suit;
    }

    public function getLevel(): int
    {
        return $this->rank->level();
    }

    public function getColor(): ColorInterface
    {
        return $this->suit->color();
    }

    public function __toString()
    {
        return [
            'rank' => $this->rank->value,
            'suit' => $this->suit->value,
            'color' => $this->suit->color(),
            'level' => $this->rank->level(),
        ];
    }


}