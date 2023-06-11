<?php

namespace Igwen6w\Ddz\Room;

use DateTime;
use Igwen6w\Ddz\Card\CardInterface;
use Igwen6w\Ddz\PackCards;
use Igwen6w\Ddz\Player\PlayerInterface;
use Igwen6w\Ddz\Exception\NotEnoughPlayersException;
use Igwen6w\Ddz\Room\FightTheLandlordPlayableEnum as Playable;
use Igwen6w\Ddz\Support\Arr;
use Igwen6w\Ddz\Validation\BombValidation;
use Igwen6w\Ddz\Validation\RocketValidation;
use Igwen6w\Ddz\Validation\ValidationInterface;

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
     * @var array<string, PlayerInterface>
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
    private PackCards $pack_cards;

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
    protected array $last_cards = [];

    /**
     * 回合内出牌次数
     *
     * @var int
     */
    protected int $round_push_count = 0;

    /**
     * 一局游戏内出牌次数
     *
     * @var int
     */
    protected int $game_push_count = 0;

    /**
     * 上一次出牌牌型或者是本轮牌型
     *
     * @var FightTheLandlordPlayableEnum|null
     */
    protected FightTheLandlordPlayableEnum|null $last_type = null;

    /**
     * 不出,过牌的玩家数量
     * 当数量为2时，开启新的一轮
     *
     * @var int
     */
    protected int $passed_player_count = 0;

    /**
     * 已经过掉的牌
     *
     * @var array<CardInterface>
     */
    protected array $pass_cards = [];

    public function __construct()
    {
        // 生成一副牌
        $this->pack_cards = new PackCards();
        // 房间创建时间
        $this->created_at = new DateTime();
    }

    /**
     * 玩家进场
     */
    public function receivePlayer(PlayerInterface $player): bool
    {
        if ($this->player_current_count === $this->player_max_count) {
            return false;
        }
        $this->players[$player->getHashId()] = $player;
        $this->player_current_count++;
        return true;
    }

    /**
     * 玩家离开
     *
     * @param PlayerInterface $player
     * @return bool
     */
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
        // 检查玩家数量
        if ($this->player_current_count !== 3) {
            throw new NotEnoughPlayersException();
        }

        // 洗牌
        $this->shuffle();

        // 切牌，17，17，17，3
        $cut_cards = $this->cut();

        // 地主的牌
        $this->landlord_cards = array_pop($cut_cards);

        // 发牌
        foreach($this->players as $key => $player) {
            $player->setCards(current($cut_cards));
            next($cut_cards);
        }

    }

    /**
     * 洗牌
     *
     * @return void
     */
    protected function shuffle(): void
    {
        shuffle($this->pack_cards->cards);
    }

    /**
     * 切牌，分牌
     *
     * @return array
     */
    public function cut(): array
    {
        $array = [];
        foreach($this->pack_cards->cards as $key => $card) {
            if ($key > 50) {
                $array[3][] = $card;
            }
            $array[$key % 3][] = $card;
        }
        return $array;
    }

    /**
     * @param array<CardInterface> $cards
     * @return array<int>
     */
    public function toNumber(array $cards): array
    {
        $levels = [];
        foreach ($cards as $card) {
            $levels[] = $card->getLevel();
        }
        return $levels;
    }

    public function getCards()
    {
        return $this->pack_cards->cards;
    }

    public function getLandlordCards(): array
    {
        return $this->landlord_cards;
    }

    public function endGame()
    {
        // 计算玩家收益

        // 通知玩家结果
    }

    /**
     * 新一轮出牌
     */
    public function newRound()
    {

    }

    /**
     * 回合内第一次出牌
     *
     * @param array<CardInterface> $cards
     * @return bool
     */
    public function firstPush(array $cards): bool
    {
        $type = $this->validation($cards);
        if ($type === Playable::Rocket) {
            $this->newRound();
            return true;
        }
        if (is_null($type)) {
            return false;
        }
        $this->updateLastType($type);
        $this->updateLastCards($cards);
        return true;
    }

    // 监听出牌
    // 监听王炸
    // 监听炸弹

    /**
     * 玩家出牌规则
     *
     * @param array<CardInterface> $cards
     * @return bool
     */
    public function rule($cards): bool
    {
        // 回合内第一次出牌
        if ($this->round_push_count == 0) {
            return $this->firstPush($cards);
        }
        // 检查当前牌组是否合规
        $class_name = $this->last_type->rule();
        /**
         * @var ValidationInterface $validator
         */
        $number_cards = $this->toNumber($cards);
        $validator = new $class_name($number_cards);
        // 验证基本牌型
        // 王炸
        if ((new RocketValidation($number_cards))->passes()) {
            // 结束本轮
            $this->newRound();
            return true;
        }
        // 之前不是炸弹,现在是炸弹
        if ($this->last_type !== Playable::Bomb
            && (new BombValidation($number_cards))->passes()
        ) {
            $this->updateLastType(Playable::Bomb);
            $this->updateLastCards($cards);
            return true;
        }
        if (! $validator->passes()) {
            return false;
        }
        // 验证长度
        if (count($cards) !== count($this->last_cards)) {
            return false;
        }
        // 比较大小
        if ($this->compare($number_cards)) {
            $this->updateLastCards($cards);
            return true;
        }
        return false;
    }

    /**
     * @param Playable|null $type
     * @return void
     */
    private function updateLastType(?FightTheLandlordPlayableEnum $type): void
    {
        $this->last_type = $type;
    }

    /**
     * @param array<CardInterface> $cards
     * @return void
     */
    private function updateLastCards(array $cards): void
    {
        $this->last_cards = $cards;
    }

    /**
     * 跟上一手牌比较大小，若大于上一手牌返回 true
     * 未做牌型验证，需要先验证牌型
     *
     * @param array<int> $number_cards
     * @return bool
     */
    private function compare(array $number_cards): bool
    {
        // 统计
        $counts_number_cards = array_count_values($number_cards);
        // 上一次出牌转数字
        $last_number_cards = $this->toNumber($this->last_cards);
        // 统计上次出牌
        $counts_last_number_cards = array_count_values($last_number_cards);
        // 验证大小
        switch (max($counts_number_cards)) {
            case 1:
            case 2:
                if (max($number_cards) > max($last_number_cards)) {
                    return true;
                }
                return false;
            case 3:
            case 4:
                if (max(Arr::keys($counts_number_cards,[3,4])) >
                    max(Arr::keys($counts_last_number_cards, [3,4]))
                ) {
                    return true;
                }
                return false;
        }
        return false;
    }

    /**
     * 验证并返回牌型
     *
     * @param array $cards
     * @return FightTheLandlordPlayableEnum|null
     */
    private function validation(array $cards): ?FightTheLandlordPlayableEnum
    {
        /**
         * @var CardInterface $card
         * @var ValidationInterface $validator
         */

        // 将牌转为数字
        $number_cards = [];
        foreach($cards as $card) {
            $number_cards[] = $card->getLevel();
        }

        // 遍历牌型，若符合某种牌型则返回该牌型
        foreach (Playable::cases() as $case) {
            $class_name = $case->rule();
            $validator = new $class_name($number_cards);
            if ($validator->passes()) {
                return $case;
            }
        }
        return null;
    }
}