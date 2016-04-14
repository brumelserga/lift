<?php

class Strategy_Check_Alreadymovingtofloor
{
    /**
     * 
     * @param ILift $lift
     * @param int $floor
     * @return int
     */
    public function getPoints(ILift $lift, $floor)
    {
        $points = 0;
        
        if ($lift->isMovingDown() && $lift->getCurrentFloor() > $floor) {
            $points += 1;
        }

        return $points;
    }
}

