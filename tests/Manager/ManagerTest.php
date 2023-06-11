<?php

namespace Igwen6w\Ddz\Test\Manager;

use Igwen6w\Ddz\Process\FightTheLandlordManager;
use Igwen6w\Ddz\Support\Node;

class ManagerTest extends \PHPUnit\Framework\TestCase
{
    public function testStatus()
    {
        $manager = new FightTheLandlordManager();
        $this->assertSame('free', $manager->currentStatus());
    }

}