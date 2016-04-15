<?php

class FloorNumber
{
    const MAX_FLOOR = 30;

    /** @var int */
    private $_number;


    /**
     * @param int $number
     */
    public function __construct($number)
    {
        $this->_guardFloorNumber($number);

        $this->_number = $number;
    }


    /**
     * @return int
     */
    public function getNumber()
    {
        return $this->_number;
    }


    /**
     * @return FloorNumber
     */
    public static function random()
    {
        return new self(rand(1, self::MAX_FLOOR));
    }


    /**
     * @param int $number
     */
    private function _guardFloorNumber($number)
    {
        if (!is_numeric($number)) {
            throw new InvalidArgumentException('Floor number must be a number');
        }

        $number = (int)$number;

        if ($number < 0 || $number > self::MAX_FLOOR) {
            throw new InvalidArgumentException(sprintf('Floor number must be in range [0 - %d]', self::MAX_FLOOR));
        }
    }


}