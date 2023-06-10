<?php

namespace Igwen6w\Ddz\Validation;

/**
 * 单张
 */
class SingleValidation implements ValidationInterface
{
    use ConstructTrait;

    public function passes(): bool
    {
        return count($this->cards) === 1;
    }

}