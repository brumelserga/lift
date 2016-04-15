<?php
/**
 * Lift manager
 */
class Lift implements ILift
{
    /**
     *
     * @var int
     */
    private $id;
    
    /**
     * @var LiftStatus
     */
    protected $_status;
    
    /**
     *
     * @var FloorNumber
     */
    protected $_currentFloor;

    /** @deprecated */
    const STATUS_FREE = 1;
    /** @deprecated */
    const STATUS_MOVING_UP = 2;
    /** @deprecated */
    const STATUS_MOVING_DOWN = 3;
    
    /**
     * 
     * @param int $id
     * @param LiftStatus $status
     * @param FloorNumber $currentFloor
     */
    public function __construct($id, LiftStatus $status, FloorNumber $currentFloor)
    {
        $this->id            = $id;
        $this->_status       = $status;
        $this->_currentFloor = $currentFloor;
    }


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * 
     * @param FloorNumber $floor
     * @return boolean
     */
    public function canBeCalled($floor)
    {
        $result = false;
        if ($this->isFree()) {
            $result = true;
        }
        
        if ($this->isMovingDown() && $this->getCurrentFloor()->getNumber() > $floor->getNumber()) {
            $result = true;
        }
        return $result;
    }
    
    /**
     * 
     * @param FloorNumber $floor
     */
    public function moveTo($floor)
    {
        echo sprintf('------%sLift #%s start moving to your floor (#%d)%s-------%s',
            PHP_EOL, $this->id, $floor, PHP_EOL, PHP_EOL
        );
    }
    
    /**
     * 
     * @param LiftStatus $status
     */
    public function setStatus($status)
    {
        $this->_status = $status;
    }
    
    /**
     * 
     * @return LiftStatus
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
        return $this->_status->getStatus() == self::STATUS_FREE;
    }
    
    /**
     * 
     * @return bool
     */
    public function isMovingDown()
    {
        return $this->_status->getStatus() == self::STATUS_MOVING_DOWN;
    }
    
    /**
     * 
     * @return bool
     */
    public function isMovingUp()
    {
        return $this->_status->getStatus() == self::STATUS_MOVING_UP;
    }
    
    /**
     * 
     * @return FloorNumber
     */
    public function getCurrentFloor()
    {
        return $this->_currentFloor;
    }
}
