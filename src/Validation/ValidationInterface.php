<?php

namespace Igwen6w\Ddz\Validation;

interface ValidationInterface
{
    /**
     * 出牌是否通过当前牌型的验证
     *
     * @return bool
     */
    public function passes(): bool;

}