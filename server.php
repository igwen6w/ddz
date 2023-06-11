<?php
/**
 * description: server
 * author: igwen6w@gmail.com
 * date: 2023/6/7
 **/

use Igwen6w\Ddz\Card\Rank\RegularRank;
use Igwen6w\Ddz\Card\Suit\RegularSuit;
use Igwen6w\Ddz\Room\FightTheLandlordPlayableEnum as Playable;

require_once "vendor/autoload.php";

//$master = new \Igwen6w\Ddz\Master();
//try {
//    $room = $master->getRoom();
//    $_cards = $room->getCards();
//    print_r($_cards);
//} catch (\Igwen6w\Ddz\Exception\NotFoundFreeRoomException $e) {
//}

$class = Playable::Bomb->rule();
$v = new $class([4,4,4,4]);




//// 对子或顺对子
//if ($max_count == 2) {
//    if ($number_count == 2) {
//        return Playable::Pair;
//    }
//    return Playable::SequencePair;
//}
//// 三张 或 三带一 或 三带二
//if ($max_count == 3 && $number_count < 6) {
//    return match($number_count) {
//        3 => Playable::Triplet,
//        4 => Playable::TripletSingle,
//        5 => Playable::TripletPair
//    };
//}
//// 三张顺子 或 三带一顺子 或 三带二顺子
//if ($max_count == 3 && $number_count >= 6) {
//    return match (min($counts)) {
//        1 => Playable::SequenceTripletWithSingle,
//        2 => Playable::SequenceTripletWithPair,
//        3 => Playable::SequenceTriplet
//    };
//}
//// 炸弹
//if ($max_count == 4) {
//    // 炸弹
//    if ($number_count == 4) {
//        return Playable::Bomb;
//    }
//    // 三带一顺子
//    if (min($counts) == 4) {
//        return Playable::SequenceTripletWithSingle;
//    }
//    // 四带二单或对
//    return Playable::QuadPlexSet;
//}
//return null;


//if (isset($this->map[$max_count])) {
//    if ($max_count == 3 && $number_count >= 6) {
//        return $this->map[$max_count]['default'][min($counts)] ?? null;
//    }
//    return $map[$max_count][$number_count] ?? $this->map[$max_count]['default'];
//}
