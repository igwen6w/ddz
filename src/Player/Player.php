<?php

namespace Igwen6w\Ddz\Player;

use Igwen6w\Ddz\Card\CardInterface;
use Igwen6w\Ddz\Room\RoomInterface;

class Player implements PlayerInterface
{
    /**
     * @var array<CardInterface>
     */
    private array $cards;
    private string $hash_id;

    private RoomInterface|null $room = null;

    public function __construct()
    {
        $this->hash_id  = spl_object_hash($this);
    }

    public function getHashId()
    {
        return $this->hash_id;
    }

    /**
     * @param array $cards
     * @return void
     */
    public function setCards(array $cards)
    {
        $this->cards = $cards;
    }

    public function sortCards(): void
    {
        if (count($this->cards) === 0) {
            return ;
        }
        usort($this->cards, function ($a, $b) {
            return $a->getLevel() <=> $b->getLevel();
        });
    }

    public function entryRoom(RoomInterface $room)
    {
        if (is_null($this->room) && $room->receivePlayer($this)) {
            $this->room = $room;
        }
    }

    /**
     * 离开房间
     * @return bool
     */
    public function leaveRoom(): bool
    {
        if (is_null($this->room)) {
            return true;
        }
        return $this->room->farewellPlayer($this);
    }

    /**
     * 叫地主
     * @param $segments
     * @return bool
     */
    public function call($segments)
    {
        // 像游戏进程发送请求
        // TODO
    }

    // 玩家出牌
    public function playCards(array $cards)
    {
        // 玩家没有这些牌
        if (! empty(array_diff($cards, $this->cards))) {
            return false;
        }
        // 向游戏进程请求出牌
        // TODO
        if (! $this->room->rule($cards)) {
            return false;
        }
        $this->cards = array_diff($this->cards, $cards);
        return true;
    }

    /**
     * @inheritDoc
     */
    public function pass()
    {
        // TODO: Implement pass() method.
        // 向游戏进程发送 pass
    }
}