<?php

namespace Igwen6w\Ddz\Test\Validation;

use Igwen6w\Ddz\Card\Rank\JokerRank;
use Igwen6w\Ddz\Validation\BombValidation;
use Igwen6w\Ddz\Validation\QuadPlexSetValidation;
use Igwen6w\Ddz\Validation\RocketValidation;
use Igwen6w\Ddz\Validation\SequenceOfPairValidation;
use Igwen6w\Ddz\Validation\SequenceOfTripletValidation;
use Igwen6w\Ddz\Validation\SequenceOfTripletWithPairValidation;
use Igwen6w\Ddz\Validation\SequenceOfTripletWithSingleValidation;
use Igwen6w\Ddz\Validation\SequenceValidation;
use Igwen6w\Ddz\Validation\SingleValidation;
use Igwen6w\Ddz\Validation\PairValidation;
use Igwen6w\Ddz\Validation\TripletValidation;
use Igwen6w\Ddz\Validation\TripletWithPairValidation;
use Igwen6w\Ddz\Validation\TripletWithSingleValidation;

class ValidationTest extends \PHPUnit\Framework\TestCase
{
    public function testSingle()
    {
        $valid = new SingleValidation([1]);
        $this->assertTrue($valid->passes());
    }

    public function testPair()
    {
        $valid_1 = new PairValidation([1, 2]);
        $this->assertFalse($valid_1->passes());
        $valid_2 = new PairValidation([2, 2]);
        $this->assertTrue($valid_2->passes());
    }

    public function testTriplet()
    {
        $this->assertTrue((new TripletValidation([3,3,3]))->passes());
    }

    public function testTripletWithSingle()
    {
        $this->assertTrue((new TripletWithSingleValidation([3,3,3,1]))->passes());
    }

    public function testTripletWithPair()
    {
        $cards = [3,3,3,2,2];
        $this->assertTrue((new TripletWithPairValidation($cards))->passes());
    }

    public function testSequence()
    {
        $v = new SequenceValidation([10,11,12,13,14]);
        $this->assertTrue($v->passes());

    }

    public function testSequenceOfPair()
    {
        $v = new SequenceOfPairValidation([13,14,13,14,12,12,11,11,10,10]);
        $this->assertTrue($v->passes());
    }

    public function testSequenceOfTriplet()
    {
        $v = new SequenceOfTripletValidation([3,3,3,4,4,4,5,5,5,6,6,6]);
        $this->assertTrue($v->passes());
    }

    public function testSequenceOfTripletWithSingle()
    {
        $v = new SequenceOfTripletWithSingleValidation([3,3,3,4,4,4,4,5,]);
        $this->assertTrue($v->passes());
    }

    public function testSequenceOfTripletWithPair()
    {
        $cards = [
            13,13,13,5,5,
            14,14,14,6,6,
//            15,15,15,7,7
        ];
        $v = new SequenceOfTripletWithPairValidation($cards);
        $this->assertTrue($v->passes());
    }

    public function testBomb()
    {
        $cards = [4,4,4,4];
        $v = new BombValidation($cards);
        $this->assertTrue($v->passes());
    }

    public function testQuad()
    {
        $cards = [
            [4,4,4,4,5,5],
            [4,4,4,4,5,5,6,6],
            [15,15,15,15,53,54]
        ];
        foreach ($cards as $card) {
            $v = new QuadPlexSetValidation($card);
            $this->assertTrue($v->passes());
        }
    }

    public function testRockerValid()
    {
        $cards = [JokerRank::RedJoker->level(), JokerRank::BlackJoker->level()];
        $v = new RocketValidation($cards);
        $this->assertTrue($v->passes());
    }

    public function testRocketNotValid()
    {
        $cards = [13, 14, 15];
        $v = new RocketValidation($cards);
        $this->assertFalse($v->passes());
    }

}