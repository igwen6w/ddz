<?php

namespace Igwen6w\Ddz\Validation;

/**
 * 三张一样的牌
 */
class TripletValidation implements ValidationInterface
{
    use ConstructTrait;

    /**
     * @inheritDoc
     */
    public function passes(): bool
    {
        $counts = count(array_count_values($this->cards));
        return (count($this->cards) === 3) && ($counts === 1);
    }
}