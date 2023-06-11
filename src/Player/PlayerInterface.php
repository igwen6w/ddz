<?php
namespace Igwen6w\Ddz\Player;

use Igwen6w\Ddz\Room\RoomInterface;

interface PlayerInterface
{

    // 叫
    public function call(mixed $segments);

    // 过
    public function pass();

    // 进入房间
    public function entryRoom(RoomInterface $room);

    // 离开房间
    public function leaveRoom(): bool;


    public function setCards(array $cards);
    public function getHashId();

}