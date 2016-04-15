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
        
        if ($lift->canBeCalled($floor)) {
            $floorDiff = $lift->getCurrentFloor()->distanceTo($floor);
            $points += (1 - round($floorDiff / FloorNumber::MAX_FLOOR, 2));
        }
        
        return $points;
    }
}

