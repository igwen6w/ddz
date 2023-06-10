<?php

namespace Igwen6w\Ddz\Test\Validation;

use Igwen6w\Ddz\Room\FightTheLandlordPlayableEnum;

class FightTheLandlordPlayableEnumTest extends \PHPUnit\Framework\TestCase
{
    public function testEnum()
    {
        $class = FightTheLandlordPlayableEnum::Bomb->rule();
        $v = new $class([4,4,4,4]);
        $this->assertTrue($v->passes());
    }

}