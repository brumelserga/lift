<?php

class Strategy_Check_Distancetofloor
    implements ICheck
{
    /**
     * 
     * @param ILift $lift
     * @param int $floor
     * @return int|float
     */
    public function getPoints(ILift $lift, $floor)
    {
        $points = 0;
        
        if ($lift->canBeCalled($floor)) {
            $floorDiff = abs($lift->getCurrentFloor() - $floor);
            $points += (1 - round($floorDiff/App::FLOORS_COUNT, 2));
        }
        
        return $points;
    }
}

