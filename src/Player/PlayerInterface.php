<?php
namespace Igwen6w\Ddz\Player;

use Igwen6w\Ddz\Room\RoomInterface;

interface PlayerInterface
{
    public function setCards(array $cards);

    /**
     * 出牌
     * @param array $cards
     * @return mixed
     */
    public function push(array $cards);

    /**
     * 过牌
     * @return mixed
     */
    public function pass();

    public function entryRoom(RoomInterface $room);

    public function leaveRoom(): bool;

    public function getHashId();

}