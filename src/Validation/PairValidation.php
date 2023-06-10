<?php

namespace Igwen6w\Ddz\Validation;

/**
 * 对子
 */
class PairValidation implements ValidationInterface
{
    use ConstructTrait;

    /**
     * @inheritDoc
     */
    public function passes(): bool
    {
        return (count($this->cards) === 2) && ($this->cards[0] === $this->cards[1]);
    }
}