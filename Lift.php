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
     * @param int $id
     * @param int|null $status
     * @param int|null $currentFloor
     */
    public function __construct($id, $status = null, $currentFloor = null)
    {
        $this->id            = $id;
        $this->_status       = !is_null($status) ? $status : self::STATUS_FREE;
        $this->_currentFloor = !is_null($currentFloor) ? $currentFloor : 1;
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
     * @param int $floor
     * @return boolean
     */
    public function canBeCalled($floor)
    {
        $result = false;
        if ($this->isFree()) {
            $result = true;
        }
        
        if ($this->isMovingDown() && $this->getCurrentFloor() > $floor) {
            $result = true;
        }
        return $result;
    }
    
    /**
     * 
     * @param int $floor
     */
    public function moveTo($floor)
    {
        echo sprintf('------%sLift #%s start moving to your floor (#%d)%s-------%s',
            PHP_EOL, $this->id, $floor, PHP_EOL, PHP_EOL
        );
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
     * @return int
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
        return $this->_status == self::STATUS_MOVING_DOWN;
    }
    
    /**
     * 
     * @return bool
     */
    public function isMovingUp()
    {
        return $this->_status == self::STATUS_MOVING_UP;
    }
    
    /**
     * 
     * @return bool
     */
    public function getCurrentFloor()
    {
        return $this->_currentFloor;
    }
}
