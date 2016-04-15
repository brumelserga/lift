<?php

class Strategy_Abstract
{
    /**
     *
     * @param ILift $lift
     * @param int $floor
     *
     * @return int
     */
    public function getPoints(ILift $lift, $floor)
    {
        $points = 0;
        foreach ($this->_checkPoints as $checkPoint) {
            $points += $checkPoint->getPoints($lift, $floor);
        }
        return $points;
    }
}

