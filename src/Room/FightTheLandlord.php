<?php

namespace Igwen6w\Ddz\Room;

use DateTime;
use Igwen6w\Ddz\Card\CardInterface;
use Igwen6w\Ddz\PackCards;
use Igwen6w\Ddz\Player\PlayerInterface;
use Igwen6w\Ddz\Exception\NotEnoughPlayersException;

/**
 * @template TKey
 */
class FightTheLandlord implements RoomInterface
{
    protected DateTime $created_at;
    /**
     * 玩家数量
     *
     * @var int
     */
    protected int $player_max_count = 3;

    protected int $player_current_count = 0;

    /**
     * 观众数量
     * @var int
     */
    protected int $spectator_count = 100;

    /**
     * 所有玩家
     * @var array<TKey, PlayerInterface>
     */
    protected array $players = [];

    protected PlayerInterface $player_a;
    protected PlayerInterface $player_b;
    protected PlayerInterface $player_c;

    /**
     * 所有观众
     * @var array
     */
    protected array $spectator = [];

    /**
     * 地主
     * @var PlayerInterface
     */
    protected PlayerInterface $landlord;

    /**
     * 农民
     * @var array
     */
    protected array $peasants = [];

    /**
     * 在当前回合中准备出牌的玩家
     * @var PlayerInterface
     */
    protected PlayerInterface $active_player;

    /**
     * 一副牌
     *
     * @var PackCards
     */
    private PackCards $cards;

    /**
     * 地主牌
     *
     * @var mixed
     */
    private array $landlord_cards;

    /**
     * 最后一次出的牌
     *
     * @var array<CardInterface>
     */
    private array $last_cards;

    /**
     * 已经过掉的牌
     *
     * @var array<CardInterface>
     */
    private array $pass_cards;

    public function __construct()
    {
        $this->cards = new PackCards();
        $this->created_at = new DateTime();
    }

    public function receivePlayer(PlayerInterface $player): bool
    {
        if ($this->player_current_count === $this->player_max_count) {
            return false;
        }
        $this->players[$player->getHashId()] = $player;
        $this->player_current_count++;
        return true;
    }

    public function farewellPlayer(PlayerInterface $player): bool
    {
        if (in_array($player->getHashId(), $this->players)) {
            unset($this->players[$player->getHashId()]);
            $this->player_current_count--;
            return true;
        }
        return false;
    }

    public function startGame()
    {
        // 检查玩家状态
        if ($this->player_current_count !== 3) {
            throw new NotEnoughPlayersException();
        }
        // 洗牌
        $this->cards->shuffle();
        // 发牌，留三张
        $cut_cards = $this->cards->cut();
        // 地主的牌
        $this->landlord_cards = array_pop($cut_cards);
        $i = 0;
        foreach($this->players as $key => $player) {
            $player->setCards($cut_cards[$i]);
            $i++;
        }
    }

    public function getCards()
    {
        return $this->cards;
    }

    public function getLandlordCards(): array
    {
        return $this->landlord_cards;
    }

    public function endGame()
    {

    }

    /**
     * 玩家出牌规则
     *
     * @param $cards
     * @return bool
     */
    public function rule($cards): bool
    {
        // 新轮次第一次出牌
        if (empty($this->last_cards)) {
            // 1张 1
            // 2张 1(2) 王炸
            // 3张 3
            // 4张 3+1 4
            // 5张 5(1) 3+2
            // 6张 6(1) 3(2)，2(3) 4+2
            // 7张 7(1)
            // 8张 8(1) 4(2) 2(4) 2(3+1)
            // 9张 9(1) 3(3)
            // 10 10(1) 5(2) 2(3+2)
            // 11 11(1)
            // 12 12(1) 6(2) 4(3) 3(4) 3(3+1) 2(4+2)
            // 13
            // 14 7(2)
            // 15 3(3+2) 5(3)
            // 16 8(2) 4(3+1) 4(4) 2(4+2+2)
            // 17
            // 18 9(2) 6(3)
            // 19
            // 20 10(2) ，5(3+1)，5(4)
        } else {

        }
        // 检查当前牌组是否合规
        // 和本轮上一次打出的牌比大小
        return false;
    }
}