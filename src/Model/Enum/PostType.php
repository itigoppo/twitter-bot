<?php

namespace TwitterBot\Model\Enum;

use Elao\Enum\ReadableEnum;

/**
 * Class PostType
 *
 * @package TwitterBot\Model\Enum
 */
final class PostType extends ReadableEnum
{
    const NORMAL = 'normal';
    const DAY = 'day';
    const TIME = 'time';
    const REPLY = 'reply';
    const MATCH = 'match';
    const BIRTHDAY = 'birthday';

    /**
     * @return array
     */
    public static function values(): array
    {
        return [
            self::NORMAL,
            self::DAY,
            self::TIME,
            self::REPLY,
            self::MATCH,
            self::BIRTHDAY,
        ];
    }

    /**
     * @return array
     */
    public static function readables(): array
    {
        return [
            self::NORMAL => '通常時',
            self::DAY => '日付イベント',
            self::TIME => '時間イベント',
            self::REPLY => '返信',
            self::MATCH => 'TLに反応',
            self::BIRTHDAY => '誕生日',
        ];
    }
}

