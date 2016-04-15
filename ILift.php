<?php
interface ILift
{
    /**
     * @return int
     */
    public function getId();

    /**
     * 
     * @param int $floor
     * @return boolean
     */
    public function canBeCalled($floor);

    /**
     * 
     * @return FloorNumber
     */
    public function getCurrentFloor();
    
    /**
     * 
     * @param int $status
     */
    public function setStatus($status);
    
    /**
     * @return bool
     */
    public function isFree();
    
    /**
     * @return bool
     */
    public function isMovingDown();
    
    /**
     * @return bool
     */
    public function isMovingUp();


    /**
     * @param int $floor
     */
    public function moveTo($floor);

    /**
     * @return LiftStatus
     */
    public function getStatus();
}