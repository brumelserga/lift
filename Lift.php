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
    private $_id;
    
    /**
     * @var LiftStatus
     */
    private $_status;
    
    /**
     *
     * @var FloorNumber
     */
    private $_currentFloor;


    /**
     * 
     * @param int $id
     * @param LiftStatus $status
     * @param FloorNumber $currentFloor
     */
    public function __construct($id, LiftStatus $status, FloorNumber $currentFloor)
    {
        $this->_id           = $id;
        $this->_status       = $status;
        $this->_currentFloor = $currentFloor;
    }


    /**
     * @return int
     */
    public function getId()
    {
        return $this->_id;
    }
    
    /**
     * 
     * @param FloorNumber $floor
     */
    public function moveTo($floor)
    {
        echo sprintf('------%sLift #%s start moving to your floor (#%d)%s-------%s',
            PHP_EOL, $this->_id, $floor, PHP_EOL, PHP_EOL
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
        return $this->_status->getStatus() == LiftStatus::FREE;
    }
    
    /**
     * 
     * @return bool
     */
    public function isMovingDown()
    {
        return $this->_status->getStatus() == LiftStatus::MOVING_DOWN;
    }
    
    /**
     * 
     * @return bool
     */
    public function isMovingUp()
    {
        return $this->_status->getStatus() == LiftStatus::MOVING_UP;
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
