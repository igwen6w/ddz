<?php

namespace Igwen6w\Ddz\Validation;

trait ConstructTrait
{
    /**
     * 转化为数字的牌面的集合
     *
     * @var array <int>
     */
    protected array $cards;

    public function __construct(array $cards)
    {
        $this->cards = $cards;
    }

}