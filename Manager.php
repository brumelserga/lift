<?php

/**
 * Lift manager
 */
class Manager
{
    /**
     *
     * @var Strategy_Abstract
     */
    private $_strategy;
    
    /**
     *
     * @var ILift[]
     */
    private $_lifts = array();


    /**
     * @param Strategy_Abstract $strategy
     */
    public function __construct(Strategy_Abstract $strategy)
    {
        $this->_strategy = $strategy;
    }


    /**
     * 
     * @param FloorNumber $floor
     * @return ILift | null
     */
    public function findBestLiftFor($floor)
    {
        $best_lift = null;
        $best_lift_points = 0;
        foreach ($this->_lifts as $lift) {
            $points = $this->_strategy->getPoints($lift, $floor);
            echo sprintf('Lift #%s has got %s points%s', $lift->getId(), $points, PHP_EOL);

            if ($best_lift_points < $points) {
                $best_lift = $lift;
                $best_lift_points = $points;
            }
        }

        return $best_lift;
    }

    /**
     * @return ILift
     */
    public function getRandomLift()
    {
        return $this->_lifts[array_rand($this->_lifts)];
    }

    /**
     * 
     * @param ILift $lift
     */
    public function appendLift(ILift $lift)
    {
        $this->_lifts[] = $lift;
    }
    
    /**
     * 
     * @param Strategy_Abstract $strategy
     */
    public function setStrategy(Strategy_Abstract $strategy)
    {
        $this->_strategy = $strategy;
    }
}

