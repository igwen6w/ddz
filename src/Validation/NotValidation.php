<?php

namespace Igwen6w\Ddz\Validation;

class NotValidation implements ValidationInterface
{

    /**
     * @inheritDoc
     */
    public function passes(): bool
    {
        return true;
    }
}