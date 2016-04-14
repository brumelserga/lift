<?php

class Strategy_Check_Free
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
        if ($lift->isFree()) {
            $points = 1;
        }
        
        return $points;
    }
}
