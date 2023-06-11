<?php

namespace Igwen6w\Ddz\Process;

use Igwen6w\Ddz\Rule\FightTheLandlordRule;
use Igwen6w\Ddz\Support\Node;

class FightTheLandlordManager
{
    // 游戏规则
    private $rule;

    // 进程状态
    // 空闲 free, 开始 start, 洗牌 shuffle, 发牌 deal ,
    // 叫地主 auction, 轮流出牌 play, 结束 over
    public Node $status;


    public function __construct()
    {
        $this->rule = new FightTheLandlordRule();
        $this->initStatus();
    }

    public function currentStatus(): string
    {
        return $this->status->name;
    }

    private function initStatus()
    {
        $status = [
            'free',
            'start',
            'shuffle',
            'deal',
            'auction',
            'play',
            'over'
        ];

        $nodes = array_map(function ($a) {
            return new Node($a);
        }, $status);

        $this->status = array_reduce($nodes, function ($a, $b) {
            return $a->setNext($b)->next();
        }, $nodes[6]);
    }

    public function processPlayerCommand($player, $command)
    {

    }

}