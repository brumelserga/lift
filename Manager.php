<?php

/**
 * Lift manager
 */
class Manager
{
    /**
     *
     * @var array
     */
    protected $_lifts = [];
    
    /**
     * 
     * @param int $floor
     * @return type
     */
    public function getLift($floor)
    {
        $points = [];
        foreach ($this->_lifts as $lift) {
            $points = $this->_strategy->getPoints($lift, $floor);
            $points[] = ['lift' => $lift, 'points' => $points];
        }
        
        $lift = $this->_chooseLiftWithMaxPoints($points);
        
        return $lift;
    }
    
    /**
     * 
     * @param ILift $lift
     */
    public function setLift(ILift $lift)
    {
        $this->_lifts[] = $lift;
    }
}

