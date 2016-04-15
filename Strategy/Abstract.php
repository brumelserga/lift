<?php

abstract class Strategy_Abstract
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
        $checkPoints = $this->_getCheckPoints();
        foreach ($checkPoints as $checkPoint) {
            $points += $checkPoint->getPoints($lift, $floor);
        }
        return $points;
    }


    /**
     * @return ICheck[]
     */
    abstract protected function _getCheckPoints();
}

