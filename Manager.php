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
    protected $_strategy;
    
    /**
     *
     * @var array
     */
    protected $_lifts = array();
    
    /**
     * 
     * @param int $floor
     * @return ILift | null
     */
    public function getLift($floor)
    {
        $result = array();
        foreach ($this->_lifts as $lift) {
            $points = $this->_strategy->getPoints($lift, $floor);
            $result[] = array('lift' => $lift, 'points' => $points);
            echo sprintf('Lift #%s has got %s points%s', $lift->id, $points, PHP_EOL);
        }
        $lift = $this->_chooseLiftWithMaxPoints($result);
        
        return $lift;
    }
    
    /**
     * 
     * @return ILift
     */
    public function changeStatusOfRandLift()
    {
        $lift = $this->_lifts[array_rand($this->_lifts)];
        $statuses = array(Lift::STATUS_FREE, Lift::STATUS_MOVING_UP, Lift::STATUS_MOVING_DOWN);
        $lift->setStatus($statuses[array_rand($statuses)]);
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
    
    /**
     * 
     * @param Strategy_Abstract $strategy
     */
    public function setStrategy(Strategy_Abstract $strategy)
    {
        $this->_strategy = $strategy;
    }
    
    /**
     * 
     * @param array $result
     * @return ILift|null
     */
    protected function _chooseLiftWithMaxPoints($result)
    {
        usort($result, function($a, $b) {
            if ($a['points'] == $b['points']) {
                return 0;
            }
            return ($a['points'] > $b['points']) ? 1 : -1;
        });

        $res = array_pop($result);
        
        return ($res['points'] > 0) ? $res['lift'] : null;
    }
}

