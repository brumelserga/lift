<?php
interface ILift
{
    /**
     * 
     * @param int $floor
     * @return boolean
     */
    public function canBeCalled($floor);

    /**
     * 
     * @return bool
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
     * @return int
     */
    public function getStatus();
}