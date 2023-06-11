<?php

namespace Igwen6w\Ddz\Process;

interface ManagerInterface extends \SplSubject
{
    // 记录过程
    public function record();

    // 新回合
    public function newRound();

    // 结束回合
    public function endRound();

    // 检查玩家操作是否合规
    public function verify();

    // 接收玩家指令
    public function receive();

    // 回放
    public function replay();


}