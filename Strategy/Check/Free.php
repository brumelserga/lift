<?php

class Strategy_Check_Free
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
        if ($lift->isFree()) {
            $points = 1;
        }
        
        return $points;
    }
}
