<?php

class Strategy_Check_Alreadymovingtofloor
    implements ICheck
{
    /**
     * 
     * @param ILift $lift
     * @param FloorNumber $floor
     * @return int
     */
    public function getPoints(ILift $lift, $floor)
    {
        $points = 0;
        
        if ($lift->isMovingDown() && $lift->getCurrentFloor()->greaterThen($floor)) {
            $points += 1;
        }
        else if ($lift->isMovingUp() && $lift->getCurrentFloor()->lowerThen($floor)) {
            $points += 1;
        }

        return $points;
    }
}

