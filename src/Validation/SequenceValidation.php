<?php

namespace Igwen6w\Ddz\Validation;

use Igwen6w\Ddz\Card\Rank\JokerRank;
use Igwen6w\Ddz\Card\Rank\RegularRank;

/**
 * 单张顺子
 */
class SequenceValidation implements ValidationInterface
{
    use ConstructTrait;

    /**
     * @inheritDoc
     */
    public function passes(): bool
    {
        if (count($this->cards) < 5) {
            return false;
        }
        // 不能出现在顺子里的牌
        $out = [
            RegularRank::Two->level(),
            JokerRank::RedJoker->level(),
            JokerRank::BlackJoker->level()
        ];
        if (0 !== count(array_intersect($out, $this->cards))) {
            return false;
        }

        $counts = array_count_values($this->cards);

        // 含有不是单张的牌
        if (count($counts) !== count($this->cards)) {
            return false;
        }

        // 判断是否连续
        return (max($this->cards) - min($this->cards)) === (count($counts) - 1);

    }
}