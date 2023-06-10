<?php

namespace Igwen6w\Ddz\Validation;

use Igwen6w\Ddz\Support\Arr;

/**
 * 连续的对子
 * 至少三对
 */
class SequenceOfPairValidation implements ValidationInterface
{
    use ConstructTrait;

    /**
     * @inheritDoc
     */
    public function passes(): bool
    {
        if (count($this->cards) < 6) {
            return false;
        }

        $counts = array_count_values($this->cards);

        if (max($counts) !== min($counts)) {
            return false;
        }
        if (2 !== max($counts)) {
            return false;
        }

        // 出现的牌型
        $cards = array_keys($counts);

        return (new SequenceValidation(Arr::fillSizeTo5($cards)))
            ->passes();
    }
}