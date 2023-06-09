<?php

namespace Igwen6w\Ddz\Room;

use Igwen6w\Ddz\Player\PlayerInterface;

interface RoomInterface
{
    /**
     * 招待玩家
     *
     * @param PlayerInterface $player
     * @return bool
     */
    public function receivePlayer(PlayerInterface $player): bool;

    /**
     * 送别玩家
     *
     * @param PlayerInterface $player
     * @return bool
     */
    public function farewellPlayer(PlayerInterface $player): bool;
    public function startGame();
    public function getCards();
    public function endGame();
    public function rule(array $cards): bool;
}