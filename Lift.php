<?php
/**
 * Lift manager
 */
class Lift implements ILift
{
    /**
     * @var int
     */
    protected $_status;
    
    /**
     *
     * @var int
     */
    protected $_currentFloor;
    
    const STATUS_FREE = 1;
    const STATUS_MOVING_UP = 2;
    const STATUS_MOVING_DOWN = 3;
    
    /**
     * 
     * @param int|null $status
     * @param int|null $currentFloor
     */
    public function __construct($status = null, $currentFloor = null)
    {
        $this->_status       = !is_null($status) ? $status : self::STATUS_FREE;
        $this->_currentFloor = !is_null($currentFloor) ? $currentFloor : 1;
    }
    
    /**
     * 
     * @param type $floor
     */
    public function moveTo($floor)
    {
        /** start moving to $floor */
    }
    
    /**
     * 
     * @param int
     */
    public function setStatus($status)
    {
        $this->_status = $status;
    }
    
    /**
     * 
     * @return void
     */
    public function getStatus()
    {
        return $this->_status;
    }
    
    /**
     * 
     * @return bool
     */
    public function isFree()
    {
        return $this->_status == self::STATUS_FREE;
    }
    
    /**
     * 
     * @return bool
     */
    public function isMovingDown()
    {
        return $this->_status == self::STATUS_DOWN;
    }
    
    /**
     * 
     * @return bool
     */
    public function isMovingUp()
    {
        return $this->_status == self::STATUS_UP;
    }
}
