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

    private static $_statusNames = [
        self::FREE => 'Free',
        self::MOVING_UP => 'Moving up',
        self::MOVING_DOWN => 'Moving down',
    ];


    /** @var int */
    private $_status;


    /**
     * @param int $status
     */
    public function __construct($status)
    {
        $this->_guardStatus($status);

        $this->_status = $status;
    }


    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->_status;
    }


    /**
     * @return string
     */
    public function getCaption()
    {
        return self::$_statusNames[$this->_status];
    }


    /**
     * @param $status
     *
     * @return bool
     */
    public function is($status)
    {
        return $this->_status == $status;
    }


    /**
     * @return LiftStatus
     */
    public static function random()
    {
        return new self(self::$_statuses[array_rand(self::$_statuses)]);
    }


    /**
     * @param int $status
     */
    private function _guardStatus($status)
    {
        if (!in_array($status, self::$_statuses))
            throw new InvalidArgumentException("Lift status invalid");
    }
}