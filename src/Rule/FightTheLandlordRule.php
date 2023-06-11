<?php

namespace Igwen6w\Ddz\Rule;

/**
 * 斗地主游戏规则
 * 抢地主规则
 * 第一次出牌规则
 * 轮次内出牌规则
 * 结束规则
 * 计分规则
 */
class FightTheLandlordRule
{

    // 叫地主
    public function bid($auction_status)
    {
        if ($auction_status->bids == 3) {
            return false;
        }
        if ($auction_status->passes == 2) {

        }

    }

    public function isValidFirst()
    {

    }

    public function isValidRound()
    {

    }

    public function isOver()
    {

    }

}