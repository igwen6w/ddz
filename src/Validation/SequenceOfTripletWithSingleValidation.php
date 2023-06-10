<?php

namespace Igwen6w\Ddz\Validation;

use Igwen6w\Ddz\Support\Arr;

/**
 * 三带一的顺子
 */
class SequenceOfTripletWithSingleValidation implements ValidationInterface
{
    use ConstructTrait;

    /**
     * @inheritDoc
     */
    public function passes(): bool
    {
        if (count($this->cards) < 8) {
            return false;
        }
        $counts = array_count_values($this->cards);

        // 3+1
        if (3 === max($counts)) {
            if (1 !== min($counts)) {
                return false;
            }
            if (array_search(2, $counts)) {
                return false;
            }
            // 三张和单张出现的次数
            $counts_counts = array_count_values($counts);
            // 每组都要有一个三张和一个单张
            if ($counts_counts[1] !== $counts_counts[3]) {
                return false;
            }
            // 取出每个三张中的一张
            $cards = array_keys($counts, 3);
            return (new SequenceValidation(Arr::fillSizeTo5($cards)))
                ->passes();
        }

        // 4+3+1 || 4+4+4
        if (4 === max($counts)) {
            // 4+4+4
            if (4 === min($counts)) {
                $cards = array_keys($counts);
                return (new SequenceValidation(Arr::fillSizeTo5($cards)))
                    ->passes();
            }
            // 4+3+1
            if (1 === min($counts)) {
                // 统计出现三张和单张出现的次数
                $counts_counts = array_count_values($counts);
                // 三张和单张的数量必须匹配
                if ($counts_counts[1] !== $counts_counts[3]) {
                    return false;
                }
                // 取出三张或四张中的一张
                $cards = Arr::keys($counts, [3,4]);
                return (new SequenceValidation(Arr::fillSizeTo5($cards)))
                    ->passes();
            }

            return false;

        }

        return false;


    }
}