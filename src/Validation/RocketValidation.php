<?php

namespace Igwen6w\Ddz\Validation;

use Igwen6w\Ddz\Card\Rank\JokerRank;

/**
 * 王炸
 */
class RocketValidation implements ValidationInterface
{
    use ConstructTrait;

    /**
     * @inheritDoc
     */
    public function passes(): bool
    {
        if (2 === count($this->cards) &&
            array_sum($this->cards) === (
                JokerRank::BlackJoker->level() +
                JokerRank::RedJoker->level()
            )
        ) {
            return true;
        }
        return false;
    }
}