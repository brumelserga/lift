<?php

class LiftsQty
{
    const MAX_LIFTS_QTY = 10;

    /** @var int */
    private $_qty;


    /**
     * @param int $qty
     */
    public function __construct($qty)
    {
        $this->_guardListsQty($qty);

        $this->_qty = $qty;
    }


    /**
     * @return int
     */
    public function getQty()
    {
        return $this->_qty;
    }


    private function _guardListsQty($qty)
    {
        if (empty($qty)) {
            throw new InvalidArgumentException('Number of lifts must be not empty');
        }

        if (!is_numeric($qty)) {
            throw new Exception('Number of lifts must be a number');
        }

        $qty = (int)$qty;

        if ($qty < 1 || $qty > self::MAX_LIFTS_QTY) {
            throw new InvalidArgumentException(sprintf('Number of lifts must be in range [0 - %d]', self::MAX_LIFTS_QTY));
        }
    }
}