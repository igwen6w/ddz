<?php

namespace Igwen6w\Ddz\Validation;

/**
 * 三张的顺子
 */
class SequenceOfTripletValidation implements ValidationInterface
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

        // 每张牌都要有三张
        if (3 !== max($counts) || 3 !== min($counts)) {
            return false;
        }

        // 取出单张
        $cards = array_keys($counts);

        // 补充到五张
        while(count($cards) < 5) {
            $cards[] = min($cards) - 1;
        }

        return (new SequenceValidation($cards))->passes();
    }
}