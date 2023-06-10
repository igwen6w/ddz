<?php

namespace Igwen6w\Ddz\Validation;

class BombValidation implements ValidationInterface
{
    use ConstructTrait;

    /**
     * @inheritDoc
     */
    public function passes(): bool
    {
        if (4 !== count($this->cards)) {
            return false;
        }
        if (max($this->cards) !== min($this->cards)) {
            return false;
        }
        return true;
    }
}