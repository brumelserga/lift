<?php

class Strategy_Check_Distancetofloor
    implements ICheck
{
    /**
     * 
     * @param ILift $lift
     * @param FloorNumber $floor
     * @return int|float
     */
    public function getPoints(ILift $lift, $floor)
    {
        $points = 0;
        
        if ($this->_liftCanBeCalledToFloor($lift, $floor)) {
            $floorDiff = $lift->getCurrentFloor()->distanceTo($floor);
            $points += (1 - round($floorDiff / FloorNumber::MAX_FLOOR, 2));
        }
        
        return $points;
    }


    /**
     *
     * @param ILift $lift
     * @param FloorNumber $floor
     * @return boolean
     */
    private function _liftCanBeCalledToFloor($lift, $floor)
    {
        $result = false;
        if ($lift->isFree()) {
            $result = true;
        }

        if ($lift->isMovingDown() && $lift->getCurrentFloor()->greaterThen($floor)) {
            $result = true;
        }
        return $result;
    }
}

