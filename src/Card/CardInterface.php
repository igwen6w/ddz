<?php

namespace Igwen6w\Ddz\Card;

use Igwen6w\Ddz\Card\Color\ColorInterface;
use Igwen6w\Ddz\Card\Rank\RankInterface;
use Igwen6w\Ddz\Card\Suit\SuitInterface;

interface CardInterface
{
    /**
     * 获取牌面等级
     *
     * @return RankInterface
     */
    public function getRank(): RankInterface;

    /**
     * 获取牌面花色
     *
     * @return SuitInterface
     */
    public function getSuit(): SuitInterface;

    /**
     * 获取牌面颜色
     *
     * @return ColorInterface
     */
    public function getColor(): ColorInterface;

    public function getLevel(): int;

    /**
     * 转换成字符串 JSON
     *
     * @return mixed
     */
    public function __toString();
}