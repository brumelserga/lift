<?php
/**
 * Strategy default
 */
class Strategy_Default extends Strategy_Abstract
{
    /**
     * Construct
     */
    public function __construct()
    {
        $this->_checkPoints = [
            new Check_Free(),
            new Check_AlreadyMovingToFloor(),
            new Check_DistanceToFloor(),
            // ...
        ];
    }
    
    /**
     * 
     * @param ILift $lift
     * @param int $floor
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

