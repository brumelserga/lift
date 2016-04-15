<?php

class LiftStatus
{
    const FREE = 1;
    const MOVING_UP = 2;
    const MOVING_DOWN = 3;


    private static $_statuses = [
        self::FREE,
        self::MOVING_UP,
        self::MOVING_DOWN,
    ];


    /**
     * @return int
     */
    public static function random()
    {
        return self::$_statuses[array_rand(self::$_statuses)];
    }
}