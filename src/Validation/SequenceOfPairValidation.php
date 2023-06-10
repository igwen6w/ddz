<?php

namespace Igwen6w\Ddz\Validation;

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

        // 按单张顺子的规则验证，需要补足数量
        while(count($cards) < 5) {
            $cards[] = min($cards) - 1;
        }

        return (new SequenceValidation($cards))->passes();
    }
}