<?php

namespace Igwen6w\Ddz\Support;

class Arr
{
    /**
     * 若数组的长度小于5，将其长度填充到5
     *
     * @param array $array
     * @return array
     */
    public static function fillSizeTo5(array $array): array
    {

        while (count($array) < 5) {
            $array[] = min($array) - 1;
        }
        return $array;
    }

    /**
     * 返回数组中指定值的键名
     *
     * @param array $array
     * @param array $values
     * @return array
     */
    public static function keys(array $array, array $values): array
    {
        $new_array = [];
        foreach ($values as $value) {
            $new_array = array_merge(array_keys($array, $value), $new_array);
        }
        return $new_array;

    }

}