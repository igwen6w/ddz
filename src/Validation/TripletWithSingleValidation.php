<?php

namespace Igwen6w\Ddz\Validation;

/**
 * 三带一
 */
class TripletWithSingleValidation implements ValidationInterface
{
    use ConstructTrait;

    /**
     * @inheritDoc
     */
    public function passes(): bool
    {
        if(count($this->cards) !== 4) {
            return false;
        }
        $counts = array_count_values($this->cards);
        if (count($counts) !== 2) {
            return false;
        }
        return max($counts) === 3 && min($counts) === 1;
    }
}