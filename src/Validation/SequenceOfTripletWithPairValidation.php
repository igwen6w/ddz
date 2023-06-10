<?php

namespace Igwen6w\Ddz\Validation;

use Igwen6w\Ddz\Support\Arr;

/**
 * 顺子，三带一对
 */
class SequenceOfTripletWithPairValidation implements ValidationInterface
{
    use ConstructTrait;

    /**
     * @inheritDoc
     */
    public function passes(): bool
    {
        if (count($this->cards) < 10) {
            return false;
        }
        // 统计三张和对子的数量
        $counts = array_count_values($this->cards);
        // 只能有三张和对子
        if (3 !== max($counts) || 2 !== min($counts)) {
            return false;
        }
        // 统计三张和对子的数量
        $counts_counts = array_count_values($counts);
        // 数量必须一致
        if ($counts_counts[3] !== $counts_counts[2]) {
            return false;
        }
        // 取出所有三张的牌型
        $cards = array_keys($counts, 3);
        return (new SequenceValidation(Arr::fillSizeTo5($cards)))
            ->passes();
    }
}