<?php

namespace Igwen6w\Ddz\Validation;

/**
 * 四带两个单张(两个单张可以是一个对子)或四带两个对子
 */
class QuadPlexSetValidation implements ValidationInterface
{
    use ConstructTrait;

    /**
     * @inheritDoc
     */
    public function passes(): bool
    {
        // 四带两单张
        if (count($this->cards) === 6) {
            $counts = array_count_values($this->cards);
            if (4 !== max($counts)) {
                return false;
            }
            return true;
        }
        // 四带两对
        if (count($this->cards) === 8) {
            $counts = array_count_values($this->cards);
            if (4 !== max($counts) || 2 !== min($counts)) {
                return false;
            }
            return true;
        }
        return false;
    }
}