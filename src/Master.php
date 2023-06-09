<?php

namespace Igwen6w\Ddz;

use Igwen6w\Ddz\Room\FightTheLandlord;
use Igwen6w\Ddz\Room\RoomInterface;
use Igwen6w\Ddz\Exception\NotFoundFreeRoomException;

class Master
{
    protected array $occupiedRooms;
    protected array $freeRooms;
    protected int $maxRoomCount = 10;

    public function __construct(int $room_count = 3)
    {
        for ($i = 1; $i <= 3; $i++) {
            $room = $this->createRoom();
            $this->freeRooms[spl_object_hash($room)] = $room;
        }
    }

    /**
     * 借用房间
     *
     * @return RoomInterface
     * @throws NotFoundFreeRoomException
     */
    public function getRoom(): RoomInterface
    {
        if (count($this->freeRooms) === 0 && $this->maxRoomCount === $this->roomCount()) {
            throw new NotFoundFreeRoomException();
        }
        if (count($this->freeRooms) >= 1) {
            $room = array_pop($this->freeRooms);
        } else {
            $room = $this->createRoom();
            $this->occupiedRooms[spl_object_hash($room)] = $room;
        }
        return $room;
    }

    /**
     * 归还房间
     *
     * @param RoomInterface $room
     * @return void
     */
    public function disposeRoom(RoomInterface $room): void
    {
        $room_id = spl_object_hash($room);
        if (isset($this->occupiedRooms[$room_id])) {
            unset($this->occupiedRooms[$room_id]);
            $this->freeRooms[$room_id] = $room;
        }
    }

    /**
     * 房间总数
     *
     * @return int
     */
    protected function roomCount(): int
    {
        return count($this->freeRooms) + count($this->occupiedRooms);
    }

    /**
     * 创建斗地主房间
     *
     * @return RoomInterface
     */
    private function createRoom()
    {
        return new FightTheLandlord();
    }

}